<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubCategoryResource\Pages;
use App\Filament\Resources\SubCategoryResource\RelationManagers;
use App\Models\SubCategory;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubCategoryResource extends Resource
{
    protected static ?string $model = SubCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('sub_category_name')
                        ->label('Sub Category name')
                        ->required(),
                    Textarea::make('sub_category_description')
                        ->label('Sub Category description')
                        ->required()
                        ->rows(2)
                        ->cols(20),
                    Textarea::make('slug')
                    ->required(),
                    Select::make('status')
                        ->required()
                        ->default(true)
                        ->options([
                            true => 'Active', // Display 'Active' when true
                            false => 'Inactive', // Display 'Inactive' when false
                        ]),
                    Select::make('category_id')
                        ->label('Main Category')
                        ->required()
                        ->relationship('category', 'category_name')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('sub_category_name')->sortable()->searchable(),
                TextColumn::make('sub_category_description')->limit(10)->sortable()->searchable(),
                TextColumn::make('category.category_name'),
                TextColumn::make('slug'),
                TextColumn::make('status')  
                ->formatStateUsing(function ($state) {
                    return $state ?("Active") : ("Inactive");
                }),
                TextColumn::make('created_at')->dateTime()->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubCategories::route('/'),
            'create' => Pages\CreateSubCategory::route('/create'),
            'edit' => Pages\EditSubCategory::route('/{record}/edit'),
        ];
    }
}
