<?php

namespace App\Filament\Resources\Students\Schemas;

use App\Models\Student;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Exists;

use function Laravel\Prompts\select;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                select::make('user_id')
                    ->label('siswa')
                    ->required()
                    ->relationship('user', 'name', fn($query) => $query->role('siswa'))
                    ->disableOptionWhen(fn($value) => Student::where('user_id', $value)->exists())
                    ->createOptionForm([
                        TextInput::make('name'),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->unique(ignoreRecord:true)
                            ->validationMessages(['unique' => 'The EMAIL has Already'])
                            ->required(),
                        Select::make('roles')
                            ->label('Roles')
                            ->relationship('roles','name',fn($query)=>$query->where('name','siswa'))
                            ->required(),
                        DateTimePicker::make('email_verified_at'),
                        TextInput::make('password')
                            ->password()
                            ->required(),
                    ]),
                select::make('classroom_id')
                    ->label('kelas')
                    ->relationship('classroom', 'name')
                    ->required(),
                TextInput::make('nisn')
                    ->required()
                    ->unique(ignoreRecord: true)
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
