<?php

namespace App\Filament\Resources\PayrollResource\Pages;

use App\Filament\Resources\PayrollResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Filters\Layout;
use Illuminate\Contracts\View\View;

class ListPayrolls extends ListRecords
{
    protected static string $resource = PayrollResource::class;

    public function getSelectedRecordsTotal($selectedRecords): mixed
    {
        $this->selectedTableRecords = $selectedRecords;

        return number_format($this->getSelectedTableRecords()->sum('cost'), 2);
    }

    protected function getTableFiltersLayout(): ?string
    {
        return Layout::AboveContent;
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableContentFooter(): ?View
    {
        return view('filament.tables.payroll-footer');
    }
}
