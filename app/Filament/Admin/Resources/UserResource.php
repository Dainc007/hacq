<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;



class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Użytkownicy';

    protected static ?string $label = 'Użytkownika';
    protected static ?string $pluralLabel = 'Użytkownicy';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Information')
                    ->label(trans('user.information'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(trans('user.name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label(trans('user.email'))
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ]),

                Forms\Components\Section::make('Personal Information')
                    ->label(trans('user.information'))
                    ->schema([
                        Forms\Components\DatePicker::make('birthday')
                            ->label(trans('user.birthday')),
                        Forms\Components\TextInput::make('personal_number')
                            ->label(trans('user.personal_number'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label(trans('user.phone'))
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('has_active_subscription')
                            ->label(trans('user.has_active_subscription'))
                            ->default(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(trans('user.id'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('user.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(trans('user.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('birthday')
                    ->label(trans('user.birthday'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(trans('user.phone'))
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('has_active_subscription')
                    ->label(trans('user.subscription')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(trans('user.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(trans('user.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

//    public static function canCreate(): bool
//    {
//        return auth()->user()->isAdmin(); // Replace with your admin check
//    }
//
//    public static function canEdit(Model $record): bool
//    {
//        return auth()->user()->isAdmin() || $record->id === Auth::user()->id;
//    }
//
//    public static function canDelete(Model $record): bool
//    {
//        return auth()->user()->isAdmin();
//    }

}
