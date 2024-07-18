<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\RelationManagers\SubCategoriesRelationManager;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\RelationManagers\ReviewsRelationManager;
use App\Models\Product;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Product Management System';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('product_name')
                        ->required(),
                    TextInput::make('product_description')
                        ->required(),
                    Select::make('category_id')
                        ->relationship('category','category_name')
                        ->required(),
                    Select::make('sub_category_id')
                        ->relationship('sub_category','sub_category_name')
                        ->required(),
                    FileUpload::make('image')
                        ->preserveFilenames()
                        ->directory('product-images')
                        ->visibility('public')
                        ->image()
                        ->imageEditor(),    
                    TextInput::make('stock')
                        ->integer()
                        ->required(),
                    TextInput::make('bought_in')
                        ->label('Bought In Price')
                        ->required(),
                    TextInput::make('price')
                        ->label('Selling Price')
                        ->numeric()
                        ->inputMode('decimal')
                        ->required(),
                    TextInput::make('stock_threshold')
                        ->helperText('Number of stock threshold that is going to get alerted when is almost out of stock')
                        ->required(),
                    Select::make('status')
                        ->options([
                            true => 'Active',
                            false => 'Inactive',
                        ])
                        ->default(true),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                ImageColumn::make('image'),
                TextColumn::make('product_name'),
                TextColumn::make('product_description')->limit(20),
                TextColumn::make('category.category_name'),
                TextColumn::make('sub_category.sub_category_name'),
                TextColumn::make('price')
                    ->label('Selling')
                    ->prefix('$'),
                TextColumn::make('bought_in')
                    ->label('Bought in')
                    ->prefix('$'),
                TextColumn::make('created_at')
                    ->dateTime('d-M-y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            ReviewsRelationManager::class,
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
