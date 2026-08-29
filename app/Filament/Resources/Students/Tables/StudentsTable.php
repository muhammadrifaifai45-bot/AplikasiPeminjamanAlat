<?php

namespace App\Filament\Resources\Students\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table

        ->contentGrid([
            'xl' => 4,
            'lg' => 3,
            'md' => 2,
        ])
            ->columns([
                Grid::make([
                    'default' => 1
                ])->schema([
                    ImageColumn::make('profile_picture')
                    ->disk('public')        
                    ->imageSize(200)
                    ->circular(),
                    TextColumn::make('user.name')
                        ->label('Student Name')
                        ->sortable()
                        ->weight(FontWeight::Bold),
                    TextColumn::make('nisn')
                        ->searchable()
                        ->icon(Heroicon::Identification),
                        TextColumn::make('classroom.name')
                        ->label('kelas')
                        ->numeric()
                        ->icon(Heroicon::BuildingOffice2)
                        ->sortable(),
                    TextColumn::make('phone_number')
                        ->icon(Heroicon::PhoneArrowDownLeft)
                        ->searchable(),
                    TextColumn::make('gender')
                        ->label('gender')
                        ->badge(),
                ]),
               
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
