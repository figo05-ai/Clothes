<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Store Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Product Details')
                        ->description('Basic information about the product.')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(255),
                            Forms\Components\Textarea::make('short_description')
                                ->required()
                                ->rows(3)
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\RichEditor::make('long_description')
                                ->required()
                                ->columnSpanFull(),
                        ])->columns(2),

                    Forms\Components\Section::make('Product Images')
                        ->description('Upload and manage images for this product.')
                        ->schema([
                            Forms\Components\Repeater::make('images')
                                ->relationship()
                                ->schema([
                                    Forms\Components\FileUpload::make('image_path')
                                        ->label('Image')
                                        ->image()
                                        ->disk('public_html')
                                        ->directory('images/products')
                                        ->required()
                                        ->columnSpan(2),
                                    Forms\Components\Group::make()->schema([
                                        Forms\Components\TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0),
                                        Forms\Components\Toggle::make('is_primary')
                                            ->label('Primary Image'),
                                    ])->columnSpan(1),
                                ])
                                ->columns(3)
                                ->defaultItems(1)
                                ->reorderable('sort_order')
                                ->collapsible()
                                ->itemLabel(fn (array $state): ?string => $state['is_primary'] ?? false ? 'Primary Image' : null),
                        ]),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Status')
                        ->schema([
                            Forms\Components\Select::make('status')
                                ->options([
                                    'draft' => 'Draft',
                                    'published' => 'Published',
                                    'out_of_stock' => 'Out of Stock',
                                ])
                                ->required()
                                ->default('draft')
                                ->native(false),
                            Forms\Components\Toggle::make('is_featured')
                                ->label('Featured Product')
                                ->default(false),
                        ]),

                    Forms\Components\Section::make('Organization')
                        ->schema([
                            Forms\Components\Select::make('subcategory_id')
                                ->relationship('subcategory', 'name')
                                ->required()
                                ->searchable()
                                ->preload()
                                ->native(false),
                            Forms\Components\TextInput::make('sku')
                                ->label('SKU (Stock Keeping Unit)')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(100),
                        ]),

                    Forms\Components\Section::make('Pricing & Inventory')
                        ->schema([
                            Forms\Components\TextInput::make('base_price')
                                ->numeric()
                                ->required()
                                ->prefix('$'),
                            Forms\Components\TextInput::make('discount_price')
                                ->numeric()
                                ->prefix('$'),
                            Forms\Components\TextInput::make('stock_quantity')
                                ->numeric()
                                ->required()
                                ->default(0),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('images.image_path')
                    ->label('Images')
                    ->getStateUsing(fn ($record) => $record->images->pluck('image_path')->map(function ($path) use ($record) {
                        $encodedPath = implode('/', array_map('rawurlencode', explode('/', $path)));
                        return asset($encodedPath) . '?v=' . $record->updated_at->timestamp;
                    })->toArray())
                    ->circular()
                    ->stacked()
                    ->limit(3),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('subcategory.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('base_price')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock_quantity')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                        'danger' => 'out_of_stock',
                    ]),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'out_of_stock' => 'Out of Stock',
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
