<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Models\Item;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'sku',
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Name' => $record->name,
            'Price' => '$'.number_format($record->price, 2),
        ];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->sku;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sku')->required()->unique(ignorable: fn (?Model $record): ?Model => $record),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('cost')
                    ->helperText('Customers won\'t see this price.')
                    ->numeric()
                    ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->money('$', ',', 2))
                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('price', number_format($state * 1.15, 2, '.', '')))
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->helperText('15% markup by default, override here.')
                    ->numeric()
                    ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->money('$', ',', 2))
                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                    ->required(),
                Forms\Components\Select::make('type')->options([
                    'fee' => 'Fee',
                    'labor' => 'Labor',
                    'part' => 'Part',
                    'tool' => 'Tool',
                ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sku'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('price')->money(shouldConvert: true),
                Tables\Columns\TextColumn::make('type')->enum([
                    'fee' => 'Fee',
                    'labor' => 'Labor',
                    'part' => 'Part',
                    'tool' => 'Tool',
                ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'fee' => 'Fee',
                        'labor' => 'Labor',
                        'part' => 'Part',
                        'tool' => 'Tool',
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
