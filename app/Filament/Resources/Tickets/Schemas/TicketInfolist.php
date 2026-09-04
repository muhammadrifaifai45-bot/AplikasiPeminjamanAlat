<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('asset_id')
                    ->numeric(),
                TextEntry::make('ticket_number'),
                TextEntry::make('qty')
                    ->numeric(),
                TextEntry::make('Booked_at')
                    ->dateTime(),
                TextEntry::make('Borrowed_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('due_at')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('returned_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
