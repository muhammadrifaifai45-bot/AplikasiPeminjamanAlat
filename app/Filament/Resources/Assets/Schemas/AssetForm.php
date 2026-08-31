<?php

namespace App\Filament\Resources\Assets\Schemas;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class AssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Fieldset::make('Detail Asset')
                    ->schema([
                        Select::make('Category_id')
                            ->relationship('category', 'name')
                            ->label('Kategori Barang')
                            ->required(),
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('code')
                            ->required(),
                    ]),

                Fieldset::make('Kondisi Asset Barang')
                    ->schema([
                        TextInput::make('good_qty')
                            ->label('jumlah barang dalam kondisi baik')
                            ->required(),
                        TextInput::make('damaged_qty')
                            ->label('jumlah barang dalam kondisi rusak')
                            ->required(),
                        TextInput::make('borrowed_qty')
                            ->label('Borowed')
                            ->required(),
                        TextInput::make('lost_qty')
                            ->label('Jumlah Barang hilang')
                            ->required(),
                        TextInput::make('total_qty')
                            ->label('Total Barang ')
                            ->required(),
                    ]),

                Toggle::make('is_available')
                    ->label('Status Barang')
                    ->required(),
            ]);
    }
}
