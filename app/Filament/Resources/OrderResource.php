<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Enums\PmMethod;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

use function Laravel\Prompts\select;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Product Management System';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('order_number')
                    ->label('Order no.')
                    ->default('OR-'.random_int(100000, 999999))
                    ->readOnly()
                    ->dehydrated()
                    ->unique(Order::class, 'order_number', ignoreRecord: true),
                Select::make('user_id')
                    ->label('Customer')
                    ->relationship('user', 'name'),
                Select::make('product_id')
                    ->relationship('product', 'product_name')
                    ->required(),
                ToggleButtons::make('status')
                    ->options(Status::class)
                    ->default(Status::PENDING)
                    ->inline()
                    ->required(),
                TextInput::make('order_date')
                    ->default(date(now()))
                    ->readOnly(),
                TextInput::make('total_amount')
                    ->numeric()
                    ->required(),
                ToggleButtons::make('payment_method')
                    ->options(PmMethod::class)
                    ->inline()
                    ->required(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('order_number')
                    ->label('Order no.'),
                TextColumn::make('product.product_name')
                    ->limit(20),
                TextColumn::make('user.name'),
                TextColumn::make('status')
                ->badge()
                ->color(function (string $state): string {
                    return match ($state){
                        'pending' => 'info',
                        'processing' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                    };
                })
                ->icon(function (string $state): string {
                    return match ($state){
                        'pending' => 'heroicon-s-exclamation-circle',
                        'processing' => 'heroicon-c-arrow-path',
                        'completed' => 'heroicon-c-check-badge',
                        'cancelled' => 'heroicon-m-x-circle',
                    };
                }),
                TextColumn::make('order_date')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
