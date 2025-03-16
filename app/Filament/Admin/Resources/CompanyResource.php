<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CompanyResource\Pages;
use App\Filament\Admin\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Firmy';

    protected static ?string $label = 'Firma';
    protected static ?string $pluralLabel = 'Firmy';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(trans('company.basic_information'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(trans('company.name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label(trans('company.description'))
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('tax_number')
                            ->label(trans('company.tax_number'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label(trans('company.phone'))
                            ->tel()
                            ->maxLength(255),
                    ]),

                Forms\Components\Section::make(trans('company.address'))
                    ->schema([
                        Forms\Components\TextInput::make('street')
                            ->label(trans('company.street'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->label(trans('company.city'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('postal_code')
                            ->label(trans('company.postal_code'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('country')
                            ->label(trans('company.country'))
                            ->maxLength(255),
                    ]),

                Forms\Components\Hidden::make('user_id')
                    ->default(fn () => auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(trans('company.id'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('company.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('tax_number')
                    ->label(trans('company.tax_number'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(trans('company.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label(trans('company.city'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->label(trans('company.country'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(trans('company.owner'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(trans('company.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(trans('company.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label(trans('company.filter_by_owner'))
                    ->relationship('user', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(trans('company.edit')),
                Tables\Actions\DeleteAction::make()
                    ->label(trans('company.delete')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(trans('company.delete')),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCompanies::route('/'),
        ];
    }
}
