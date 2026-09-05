<?php

namespace App\Filament\Resources\Tickets\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ticket_number')
                    ->label('Ticket#')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Requester')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('asset.name')
                    ->label('Asset Name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('Booked_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('Borrowed_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('due_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->formatStateUsing(fn(string $state): string =>match ($state) {
                        'Booked' => 'Reserved',
                        'Borowwed' => 'On Loan',
                        'Verifiying' => 'Review',
                        'returned' => 'Returned',
                        'cancelled' => 'Cancelled',
                        default => ucfirst($state)
                    })

                    ->formatStateUsing(fn(string $state): string => match($state){
                        'Booked' => 'info',
                        'Borowwed' => 'success',
                        'Verifiying' => 'warning',
                        'Returned' => 'success',
                        'cancelled' => 'danger',
                    })

                    ->badge(),
                TextColumn::make('returned_at')
                    ->dateTime()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->recordActions([


                Action::make('Approve Borowwing')
                    ->label('Approve Borowwing')
                    ->color('warning')
                    ->visible(fn($record) => $record->status === 'Booked')
                    ->action(fn($record) => $record->update([
                        'status' => 'Borowwed',
                        'Borrowed_at' => now(),
                    ]))->button(),

                Action::make('Cancell Borowwing')
                    ->label('Reject')
                    ->color('danger')
                    ->visible(fn($record) => $record->status === 'Booked')
                    ->action(fn($record) => $record->update([
                        'status' => 'cancelled',
                    ]))->button(),

                Action::make('Verify return')
                    ->label('Verify Return')
                    ->color('warning')
                    ->visible(fn($record) => $record->status === 'Borowwed')
                    ->action(fn($record) => $record->update([
                        'status' => 'Verifiying',
                    ]))->button(),

                Action::make('completed')
                    ->label('Completed')
                    ->color('success')
                    ->visible(fn($record) => $record->status === 'Verifiying')
                    ->action(fn($record) => $record->update([
                        'status' => 'returned',
                        'returned_at' => now(),
                    ]))->button(),
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
