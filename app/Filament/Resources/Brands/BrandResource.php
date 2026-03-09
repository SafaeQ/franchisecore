<?php

namespace App\Filament\Resources\Brands;

use App\Filament\Resources\Brands\Pages\CreateBrand;
use App\Filament\Resources\Brands\Pages\EditBrand;
use App\Filament\Resources\Brands\Pages\ListBrands;
use App\Models\Brand;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static string | UnitEnum | null $navigationGroup = 'Franchise';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('tag')
                    ->required()
                    ->maxLength(30)
                    ->rule('regex:/^[A-Z0-9_]+$/')
                    ->helperText('Tag en MAJUSCULES, ex: BURGER_KING'),
                TextInput::make('logo')->maxLength(255),
                TextInput::make('favicon')->maxLength(255),
                Select::make('theme_id')
                    ->relationship('theme', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('sms_phone_number')->tel()->maxLength(50),
                TextInput::make('email_from_address')->email()->maxLength(255),
                TextInput::make('email_from_name')->maxLength(255),
                KeyValue::make('design_config')
                    ->keyLabel('Clé')
                    ->valueLabel('Valeur')
                    ->reorderable(),
                KeyValue::make('links')
                    ->keyLabel('Plateforme')
                    ->valueLabel('URL')
                    ->reorderable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('tag')->sortable(),
                TextColumn::make('theme.name')->label('Theme')->sortable(),
                TextColumn::make('sms_phone_number')->label('SMS')->toggleable(),
                TextColumn::make('email_from_address')->label('Email from')->toggleable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name');
    }

    /**
     * @return array<string, \Filament\Resources\Pages\PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListBrands::route('/'),
            'create' => CreateBrand::route('/create'),
            'edit' => EditBrand::route('/{record}/edit'),
        ];
    }
}
