<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

use function Laravel\Prompts\select;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ticket sesion')
                    ->description('Assigned an asset to requester and set  expected returned data')
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->relationship('user', 'name', fn($query) => $query->role('siswa'))
                            ->required(),
                        Select::make('asset_id')
                            ->label('Asset Name')
                            ->relationship('asset', 'name')
                            ->required(),
                        DatePicker::make('due_at')
                        ->label('Due dat'),
                        Textarea::make('note')
                         ->label('Additional Note')
                         ->columnSpanFull(),

                    ])->columns(3)

                    // untuk mengfulkan section 
                    ->columnSpanFull()


            ]);
    }
}
