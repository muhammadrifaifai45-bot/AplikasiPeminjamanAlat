<?php

namespace App\Filament\Resources\Assets\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ColumnGroup;
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
                ColumnGroup::make('Detail Asset',[
                    ImageColumn::make('image')
                    ->disk('public')
                    ->label('Image Asset')
                    ->imageSize(50),
                TextColumn::make('name')
                    ->label('name')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('code')
                    ->searchable(),
                TextColumn::make('Category.name')
                    ->label('Category')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->searchable(),
                ]),

                ColumnGroup::make('Kondisi Asset',[
                    TextColumn::make('good_qty')
                    ->label('good')
                    ->numeric(),
                TextColumn::make('damaged_qty')
                    ->label('damaged')
                    ->numeric(),
                TextColumn::make('borrowed_qty')
                    ->label('Borrowed')
                    ->numeric(),
                TextColumn::make('lost_qty')
                    ->label('lost')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('available_qty')
                    ->label('Available')
                    ->numeric(),
                TextColumn::make('total_qty')
                    ->label('total')
                    ->numeric(),
                ]),
                
                IconColumn::make('is_available')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    ->relationship('category', 'name'),
                TernaryFilter::make('is_available')
                    ->label('availabality')
            ])
            ->recordActions([
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
