<?php

namespace App\Filament\Resources\Assets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AssetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                ->disk('public')
                ->label('Image Asset')
                ->imageSize(50),
                TextColumn::make('Category.name')
                    ->label('Category')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('name')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('code')
                    ->searchable(),
                TextColumn::make('good_qty')
                    ->label('good')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('damaged_qty')
                    ->label('damaged')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('borrowed_qty')
                    ->label('Borrowed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('lost_qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('available_qty')
                ->label('Available')
                ->numeric()
                ->sortable(),
                TextColumn::make('total_qty')
                    ->label('total')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('is_available')
                    ->boolean(),
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
                SelectFilter::make('category_id')
                ->relationship('category','name'),
                TernaryFilter::make('is_available')
                ->label('availabality')
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
