<?php

namespace App\Filament\Resources\Classrooms\Schemas;

use App\Models\Major;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

use function Laravel\Prompts\select;

class ClassroomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('major_id')
                    ->required()
                    ->label('Major')
                    ->relationship('Major','name')
                    ->options(Major::where('is_active' ,true)->pluck('name','id')),
                TextInput::make('name')
                    ->required(),
                Select::make('level')
                    ->required()
                    ->label('kelas')
                    ->options([
                        10 => 'kelas X',
                        11 => 'kelas XI',
                        12 => 'kelas XII'
                    ]),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
