<?php

namespace App\Filament\Resources\Assets\Schemas;

use App\Models\Asset;
use App\Models\Category;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AssetForm
{
    protected static function recalculateStock(Get $get, Set $set): void
    {
        $good = (int) $get('good_qty');
        $damage = (int) $get('damaged_qty');
        $borrowed = (int) $get('borrowed_qty');
        $lost = (int) $get('lost_qty');

        $set('available_qty', $good - $borrowed);
        $set('total_qty', $good + $damage + $lost + $borrowed);
    }
    public static function configure(Schema $schema): Schema
    {

        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Fieldset::make('Detail Asset')
                            ->schema([

                                Select::make('Category_id')
                                    ->relationship('category', 'name')
                                    ->label('Kategori Barang')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function (Get $get, Set $set) {

                                        //Logic mencari variable dengan membungkus menggunakan variable $kategori dengan Category::find berdasarkan 'category_id'
                                        $kategori = Category::find($get('category_id'));

                                        if ($kategori) {
                                            return;
                                        }

                                        $prefix = strtoupper(Str::substr($kategori->name, 0, 3));

                                        
                                        $KodeTerakhir = Asset::where('code', 'like', $prefix, '%')
                                            ->orderBy('code', 'desc')
                                            ->value('code');

                                        if ($KodeTerakhir) {
                                            $nomor = (int) substr($KodeTerakhir, 3);
                                            $nomorselanjutnya = $nomor + 1;
                                        }else{
                                            $nomorselanjutnya =1;
                                        }
                                        $kode = $prefix.str_pad($nomorselanjutnya, 3, '0', STR_PAD_LEFT);
                                        $set('kode',$kode);
                                    }),

                                TextInput::make('code')
                                    ->required()
                                    ->reactive()
                                    ->readOnly(),


                                TextInput::make('name')
                                    ->columnSpanFull()
                                    ->required(),

                            ]),
                        Toggle::make('is_available')
                            ->label('Status')
                            ->required(),
                    ])->columnSpan(2),




                Fieldset::make('Asset Condition / Stock')
                    ->schema([
                        TextInput::make('good_qty')
                            ->numeric()
                            ->label('good')
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculateStock($get, $set)),
                        TextInput::make('damaged_qty')
                            ->numeric()
                            ->label('Damaged')
                            ->reactive()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculateStock($get, $set))
                            ->default(0)
                            ->required(),
                        TextInput::make('borrowed_qty')
                            ->numeric()
                            ->label('Borowed')
                            ->default(0)
                            ->reactive()
                            ->required(),
                        TextInput::make('lost_qty')
                            ->numeric()
                            ->label('Jumlah Barang hilang')
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculateStock($get, $set))
                            ->required(),

                        TextInput::make('available_qty')
                            ->numeric()
                            ->label('Available')
                            ->belowContent('Available Asset for Borowwing')
                            ->readOnly()
                            ->default(0)
                            ->required(),
                        TextInput::make('total_qty')
                            ->numeric()
                            ->label('Total')
                            ->readOnly()
                            ->default(0)
                            ->required(),
                    ])->columnSpan(1),

            ])->columns(3);
    }
}
