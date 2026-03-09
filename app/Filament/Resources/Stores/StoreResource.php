<?php

namespace App\Filament\Resources\Stores;

use App\Filament\Resources\Stores\Pages\CreateStore;
use App\Filament\Resources\Stores\Pages\EditStore;
use App\Filament\Resources\Stores\Pages\ListStores;
use App\Models\Store;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class StoreResource extends Resource
{
    protected static ?string $model = Store::class;

    protected static string | UnitEnum | null $navigationGroup = 'Franchise';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                TextInput::make('franchise_number')->maxLength(255),
                TextInput::make('primary_color')->maxLength(20),
                TextInput::make('secondary_color')->maxLength(20),
                TextInput::make('logo')->maxLength(255),
                TextInput::make('address')->maxLength(255),
                TextInput::make('city')->maxLength(255),
                TextInput::make('province')->maxLength(255),
                TextInput::make('postal_code')->maxLength(20),
                TextInput::make('phone')->tel()->maxLength(50),
                TextInput::make('email')->email()->maxLength(255),
                Toggle::make('is_active')->default(true),
                Select::make('project_type')
                    ->options([
                        'Nouveau' => 'Nouveau',
                        'Corpo' => 'Corpo',
                        'Reprise' => 'Reprise',
                        'Vente' => 'Vente',
                    ]),
                DatePicker::make('start_date'),
                DatePicker::make('expected_opening_date'),
                Select::make('core_store_id')
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Restaurant parent'),
                Select::make('store_employee_id')
                    ->relationship('manager', 'id')
                    ->searchable()
                    ->preload()
                    ->label('Responsable principal'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('brand.name')->label('Brand')->sortable(),
                TextColumn::make('slug')->searchable(),
                TextColumn::make('franchise_number')->label('No. franchisé')->toggleable(),
                TextColumn::make('project_type')->badge(),
                IconColumn::make('is_active')->boolean()->label('Actif'),
                TextColumn::make('city')->toggleable(),
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
            'index' => ListStores::route('/'),
            'create' => CreateStore::route('/create'),
            'edit' => EditStore::route('/{record}/edit'),
        ];
    }
}
