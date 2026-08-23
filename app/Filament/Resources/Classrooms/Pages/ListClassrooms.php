<?php

namespace App\Filament\Resources\Classrooms\Pages;

use App\Filament\Resources\Classrooms\ClassroomResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListClassrooms extends ListRecords
{
    protected static string $resource = ClassroomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }


    public function getTabs(): array
{
    return [
        'all' => Tab::make(),
        'kelas_10' => Tab::make('kelas X')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('level', 10)),
        'kelas_xi' => Tab::make('kelas XI')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('level', 11)),
            'kelas_12'=> Tab::make('kelas XII')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('level',12)),
    ];
}
}
