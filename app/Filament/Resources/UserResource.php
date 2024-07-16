<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'User Roles & Permission';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                FileUpload::make('avatar_url')
                        ->preserveFilenames()
                        ->directory('avatars')
                        ->visibility('public')
                        ->image()
                        ->imageEditor(), 
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                TextInput::make('current_password')
                    ->label(__('Current password'))
                    ->password()
                    ->revealable(true)
                        ->rules([
                            function () {
                                return function (string $attribute, $value, Closure $fail) {
                                    if (! Hash::check($value, auth()->user()->password)) {
                                        $fail('Current password is incorrect.');
                                    }
                                };
                            },
                        ]),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->confirmed()
                    ->revealable(true)
                    ->required(fn(Page $livewire) => ($livewire instanceof CreateUser))
                    ->maxLength(255),
                TextInput::make('password_confirmation')
                    ->password()
                    ->revealable(true),
                Select::make('permissions')
                    ->multiple()
                    ->relationship('permissions', 'name')->preload(),
                Select::make('roles')
                    ->multiple()
                    ->relationship('roles', 'name')->preload(),
                ])->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                ImageColumn::make('avatar_url')
                ->label('Avatar')
                ->circular()
                ->size(90),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->copyable()
                    ->searchable(),
                TextColumn::make('roles.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-M-y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d-M-y')
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
