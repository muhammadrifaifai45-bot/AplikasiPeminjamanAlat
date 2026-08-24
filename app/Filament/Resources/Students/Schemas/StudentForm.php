<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

use function Laravel\Prompts\select;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                select::make('user_id')
                    ->label('siswa')
                    ->relationship('user','name')
                    ->required(),
                select::make('classroom_id')
                    ->label('kelas')
                    ->relationship('classroom','name')
                    ->required(),
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
                FileUpload::make('profile_picture')
                    ->label('Profile Picture')
                    ->disk('public')
                    ->default(null),
            ]);
    }
}
