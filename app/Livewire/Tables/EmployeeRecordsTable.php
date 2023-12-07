<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\EmployeeRecords;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\{LinkColumn, ImageColumn};

class EmployeeRecordsTable extends DataTableComponent
{
    protected $model = EMployeeRecords::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable(),
            Column::make('First Name', 'firstName')
                ->sortable()
                ->searchable(),
            Column::make('Last Name', 'lastName')
                ->sortable()
                ->searchable(),
            Column::make('Gender', 'gender')
                ->sortable()
                ->searchable(),
            Column::make('Birthday', 'birthday')
                ->sortable()
                ->searchable(),
            Column::make('Monthly Salary', 'monthlySalary')
                ->sortable()
                ->searchable(),
            LinkColumn::make('Edit')
                ->title(fn($row) => '🖊️')
                ->location(fn($row) => route('update-employee-record', ['id' => $row])),
        ];
    }
}
