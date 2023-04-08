<?php

namespace App\Filament\Resources\WorkorderResource\Pages;

use App\Filament\Resources\WorkorderResource;
use Filament\Resources\Pages\EditRecord;

class EditWorkorder extends EditRecord
{
    protected static string $resource = WorkorderResource::class;

    protected function getActions(): array
    {
        return [
            \Filament\Pages\Actions\Action::make('open')->label('Mark Open')->icon('heroicon-s-folder-open')->color('warning')->action('markOpen'),
            \Filament\Pages\Actions\Action::make('completed')->label('Mark Completed')->icon('heroicon-s-check')->color('success')->action('markCompleted'),
            \Filament\Pages\Actions\Action::make('pdf')->label('PDF')->icon('heroicon-s-document-download')->url('https://acornspro.ewr1.vultrobjects.com/PDFs/' . $this->record->po . '.pdf', true),
        ];
    }

    public function markOpen(): void
    {
        $this->record->statuses()->create([
            'name' => 'Open',
        ]);

        redirect(request()->header('Referer'));
    }

    public function markCompleted(): void
    {
        $this->record->statuses()->create([
            'name' => 'Completed',
        ]);

        redirect(request()->header('Referer'));
    }
}
