<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PayrollResource\Pages;
use App\Models\Payroll;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class PayrollResource extends Resource
{
    protected static ?string $pluralLabel = 'payroll';

    protected static ?string $model = Payroll::class;

    protected static ?string $navigationIcon = 'heroicon-o-cash';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('po'),
                Forms\Components\TextInput::make('cost')
                    ->numeric()
                    ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->money('$', ',', 2))
                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('po')
                    ->searchable()
                    ->sortable()
                    ->label('PO'),
                Tables\Columns\TextColumn::make('workorderItem.workorder.service_date')
                    ->sortable()
                    ->label('Service Date')
                    ->date(),
                Tables\Columns\TextColumn::make('workorderItem.workorder.location')
                    ->searchable()
                    ->sortable()
                    ->label('Location')
                    ->limit(50),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->sortable()
                    ->default('Unpaid')
                    ->label('Paid at'),
                Tables\Columns\TextColumn::make('cost')->money(shouldConvert: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->filters(
                [
                    Tables\Filters\SelectFilter::make('name')
                        ->options(
                            array_combine(Arr::flatten(Payroll::select('name')->distinct()->get()->toArray()), Arr::flatten(Payroll::select('name')->distinct()->get()->toArray()))
                        )
                        ->column('name'),
                    Tables\Filters\TernaryFilter::make('payout_status')
                        ->placeholder('Unpaid')
                        ->trueLabel('Unpaid & Paid')
                        ->falseLabel('Paid')
                        ->queries(
                            true: fn (Builder $query) => $query->withTrashed(),
                            false: fn (Builder $query) => $query->onlyTrashed(),
                            blank: fn (Builder $query) => $query->withoutTrashed(),
                        ),
                    Tables\Filters\Filter::make('deleted_at')
                        ->form([
                            Forms\Components\DatePicker::make('paid_from'),
                            Forms\Components\DatePicker::make('paid_until'),
                        ])
                        ->query(function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['paid_from'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('deleted_at', '>=', $date),
                                )
                                ->when(
                                    $data['paid_until'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('deleted_at', '<=', $date),
                                );
                        }),
                ]
            )->bulkActions([
                Tables\Actions\BulkAction::make('pay')
                    ->action(fn (Collection $records) => $records->each->delete())
                    ->requiresConfirmation()
                    ->color('success')
                    ->icon('heroicon-o-cash'),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayrolls::route('/'),
        ];
    }
}
