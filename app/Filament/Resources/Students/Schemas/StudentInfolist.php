<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile Picture')
                    ->schema([
                        ImageEntry::make('profile_picture')
                            ->disk('public')
                            ->imageHeight(300)
                            ->hiddenLabel()
                            ->alignCenter()
                            ->circular(),
                    ])->columnSpan(1),

                Section::make('Siswa Information ')
                    ->schema([

                        TextEntry::make('user.name')
                            ->label('Nama siswa/i')
                            ->icon(Heroicon::UserCircle)
                            ->numeric(),
                        TextEntry::make('nisn')
                            ->icon(Heroicon::CreditCard)
                            ->label('NISN :'),
                        TextEntry::make('classroom.name')
                            ->label('kelas')
                            ->icon(Heroicon::BuildingLibrary)
                            ->numeric(),
                        TextEntry::make('gender')
                            ->badge(),
                        TextEntry::make('phone_number')
                            ->icon(Heroicon::PhoneArrowUpRight)
                            ->label('Kontak siswa'),
                        TextEntry::make('adress')
                            ->icon(Heroicon::MapPin)
                            ->label('Alamat Siswa'),


                    ])->columnSpan(2)
                    ->columns(3)


                // TextEntry::make('created_at')
                //     ->dateTime()
                //     ->placeholder('-'),
                // TextEntry::make('updated_at')
                //     ->dateTime()
                //     ->placeholder('-'),
            ])->columns(3);
    }
}
