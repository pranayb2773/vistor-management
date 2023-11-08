<?php

namespace App\Http\Traits;

use Livewire\WithPagination;

trait WithPerPagePagination
{
    use WithPagination;

    public int $perPage = 10;
    public array $perPageAccepted = [10, 25, 50];

    public function mountWithPerPagePagination(): void
    {
        $this->perPage = session()->get('perPage', $this->perPage);
    }

    public function updatedPerPage($value): void
    {
        session()->put('perPage', $value);
        $this->reset(['selected', 'selectAll', 'selectPage', 'page']);
        $this->resetPage();
    }

    public function applyPagination($query)
    {
        return $query->paginate((int) $this->perPage);
    }
}
