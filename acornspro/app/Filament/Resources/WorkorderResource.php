<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use App\Models\Item;
use Filament\Tables;
use App\Models\Workorder;
use Filament\Resources\Form;
use App\Models\WorkorderItem;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use function PHPSTORM_META\type;
use PhpParser\Node\Expr\CallLike;
use Filament\Forms\FormsComponent;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;

use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Filament\Resources\WorkorderResource\Pages;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;
use App\Filament\Resources\WorkorderResource\RelationManagers;
use App\Filament\Resources\WorkorderResource\Pages\EditWorkorder;
use App\Filament\Resources\WorkorderResource\Pages\ListWorkorders;
use App\Filament\Resources\WorkorderResource\Pages\CreateWorkorder;
use App\Filament\Resources\WorkorderResource\RelationManagers\StatusesRelationManager;

class WorkorderResource extends Resource
{
    protected static ?string $model = Workorder::class;


    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('po')
                                            ->label('PO #')
                                            ->autofocus()
                                            ->required(),
                                        Forms\Components\DateTimePicker::make('service_date')
                                            ->weekStartsOnSunday()
                                            ->withoutSeconds()
                                            ->required(),
                                        Forms\Components\TextInput::make('store')
                                            ->required(),
                                        Forms\Components\TextInput::make('location')
                                            ->label(fn (?Workorder $record): HtmlString => $record ? new HtmlString('<a class="hover:underline focus:outline-none focus:underline filament-tables-link text-primary-600 hover:text-primary-500 dark:text-primary-500 dark:hover:text-primary-400 text-sm font-medium filament-tables-link-action" href="https://www.google.com/maps/search/?api=1&query=' . explode(',', str_replace(' ', '+', $record->location))[0] . '&dirflag=d">Location</a>') : new HtmlString('Location'))
                                            ->hintIcon('heroicon-o-map')
                                            ->required(),
                                        Forms\Components\MarkdownEditor::make('sow')
                                            ->columnSpan(2)
                                            ->required(),
                                    ]),
                            ]),
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('Items'),
                                Forms\Components\Repeater::make('items')
                                    ->relationship()

                                    ->schema([
                                        Forms\Components\TextInput::make('type')
                                        ->extraAttributes(['style' => 'margin-top: -66px;'])
                                        ->disabled()
                                        ->afterStateHydrated(function (TextInput $component, $state) {
                                            $component->state(strtoupper($state));
                                        })
                                       ->label(__(' '))
                                    //    ->extraAttributes(['class' => 'mt-8'])
                                        ->id('items-type')
                                        ->columnSpan([
                                            'md' => 2,
                                        ])
                                        ,
                                        Forms\Components\Select::make('item_id')
                                            ->options(\App\Models\Item::query()->pluck('full_name', 'id'))
                                            ->searchable()
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set, Closure $get) {
                                                $set('cost', \App\Models\Item::find($state)?->cost ?? 0);
                                                $set('price', \App\Models\Item::find($state)?->price ?? 0);
                                                $set('type', \App\Models\Item::find($state)?->type ?? '-');
                                                $set('total',  $get('qty') * \App\Models\Item::find($state)?->price);
                                            })
                                            ->columnSpan([
                                                'md' => 12,
                                            ]),

                                        Forms\Components\TextInput::make('cost')
                                            ->numeric()
                                            ->required()
                                            ->columnSpan([
                                                'md' => 3,
                                            ]),
                                        Forms\Components\TextInput::make('price')
                                            ->numeric()
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set, Closure $get) {

                                                $set('total',  $get('qty') * $state);
                                            })
                                            ->columnSpan([
                                                'md' => 3,
                                            ]),
                                        Forms\Components\TextInput::make('qty')

                                            ->numeric()

                                            ->default(1)
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set, Closure $get) {

                                                $price = $get('price');
                                                $set('total', $state * $price);
                                            })
                                            ->columnSpan([
                                                'md' => 2,
                                            ]),


                                        Forms\Components\TextInput::make('total')
                                            ->numeric()
                                            ->reactive()
                                            ->required()
                                            ->columnSpan([
                                                'md' => 3,
                                            ]),
                                        // Forms\Components\TextInput::make('type')
                                        //     ->id('type-item')
                                        //
                                        //     ->columnSpan([
                                        //         'md' => 12,
                                        //     ]),

                                    ])
                                    ->dehydrated()
                                    ->defaultItems(0)
                                    ->disableLabel()
                                    ->columns([
                                        'md' => 10,
                                    ]),

                                    // Forms\Components\TextInput::make('grand-total')->placeholder(''),
                                     Forms\Components\Placeholder::make('label')
                                     ->extraAttributes(['class' => 'text-right font-bold'])
                                    ->id('g_total')->label(__(' '))
                                    ->content(function ($get) {
                                        return "Grand Total: ".collect($get('items'))
                                            ->pluck('total')
                                            ->sum();
                                    })
                                    ->columns([
                                        'md' => 12,
                                    ]),
                             ]),

                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('rep')
                            ->label(fn (?Workorder $record): HtmlString => $record ? new HtmlString("<a class=\"hover:underline focus:outline-none focus:underline filament-tables-link text-primary-600 hover:text-primary-500 dark:text-primary-500 dark:hover:text-primary-400 text-sm font-medium filament-tables-link-action\" href=\"tel:$record->rep_number\">Rep</a>") : new HtmlString('Rep'))
                            ->hintIcon('heroicon-o-phone-outgoing')
                            ->required(),
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (?Workorder $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (?Workorder $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                        Forms\Components\TextInput::make('nte')
                            ->label('NTE')
                            ->numeric()
                            ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->money('$', ',', 2))
                            ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                            ->required(),
                        Forms\Components\TextInput::make('payout')
                            ->numeric()
                            ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->money('$', ',', 2))
                            ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/']),
                    ])
                    ->columnSpan(1),
                    
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('po')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning',
                        'primary' => 'Completed',
                        'danger' => 'Open',
                        'success' => 'PO Paid',
                    ]),
                Tables\Columns\TextColumn::make('store')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'open' => 'Open',
                        'invoice' => 'Invoice',
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'po paid' => 'PO Paid',
                        'needs quote' => 'Needs Quote',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('open'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\StatusesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkorders::route('/'),
            'create' => Pages\CreateWorkorder::route('/create'),
            'edit' => Pages\EditWorkorder::route('/{record}/edit'),
        ];
    }
}
