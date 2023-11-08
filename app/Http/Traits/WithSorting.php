<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithSorting
{
    public string $sortColumn = '';
    public string $sortDirection = '';


    public function sortBy(string $field): void
    {
        if ($this->sortColumn === $field && $this->sortDirection === 'desc') {
            $this->reset(['sortColumn', 'sortDirection']);
            return;
        } elseif ($this->sortColumn === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }
        else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumn = $field;
    }

    public function applySorting(Builder $query): Builder
    {
        return empty($this->sortColumn) ? $query : $query->orderBy($this->sortColumn, $this->sortDirection);
    }
}
