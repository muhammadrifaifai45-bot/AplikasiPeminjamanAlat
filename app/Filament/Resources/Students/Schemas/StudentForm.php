<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->label('siswa')
                    ->relationship('user','name'),
                TextInput::make('classroom_id')
                    ->required()
                    ->label('kelas')
                    ->relationship('clasroom','name'),  
                TextInput::make('nisn')
                    ->required()
                    ->unique(ignoreRecord:true)
                    ->validationMessages(['unique' => 'The NISN has Already'])
                    ->label('NISN'),
                TextInput::make('phone_number')
                    ->tel()
                    ->required(),
                Select::make('gender')
                    ->label('gender')
                    ->options(['male' => 'Male', 'female' => 'Female'])
                    ->required(),
                Textarea::make('adress')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('profile_picture')
                    ->default(null),
            ]);
    }
}
