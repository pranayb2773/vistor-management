<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Traits\WithBulkActions;
use App\Http\Traits\WithPerPagePagination;
use App\Http\Traits\WithSorting;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Livewire\Component;

/**
 * @property Collection<User> $rows
 * @property Builder $selectedRowsQuery
 * @property mixed $rowsQuery
 */
class Index extends Component
{
    use WithPerPagePagination;
    use WithBulkActions;
    use WithSorting;
    use AuthorizesRequests;

    //protected $queryString = ['sortColumn', 'sortDirection'];
    protected $listeners = ['refreshUsers' => '$refresh'];


    public bool $showDeleteModal = false;
    public string $search = '';
    public string $updatedAt = '';

    public function mount(): void
    {
        $this->authorize('view-user');
    }

    public function updated(string $propertyName): void
    {
        if (!in_array($propertyName, ['search', 'updatedAt'])) {
            return;
        }

        $this->reset(["selected", "selectAll", "selectPage"]);
        $this->resetPage();
    }

    public function resetAll(): void
    {
        $this->resetExcept();
    }

    public function deleteSelected(): void
    {
        $this->showDeleteModal = false;

        if (empty($this->selected)) {
            $this->dispatchBrowserEvent('notify', [
                'content' => 'No user(s) has been selected!',
                'type' => 'error'
            ]);

            return;
        }

        $this->selectedRowsQuery->delete();

        $this->resetAll();
        $this->dispatchBrowserEvent('notify', [
            'content' => 'The selected users(' . count($this->selected) . ') deleted successfully.',
            'type' => 'success'
        ]);
    }

    public function getRowsQueryProperty(): Builder
    {
        $query = User::with(['roles'])
            ->when($this->search, fn(Builder $query, $search) => $query->whereLike(['first_name', 'last_name'], $search))
            ->when($this->updatedAt, fn(Builder $query, $updatedAt) => $query->whereLike('updated_at', Carbon::parse($updatedAt)->format('Y-m-d')));

        empty($this->sortColumn) && $query->orderByDesc('updated_at');

        return $this->applySorting($query);
    }

    public function getRowsProperty(): LengthAwarePaginator
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.admin.user.index', [
            'users' => $this->rows,
        ])->layout('layouts.admin', [
            'pageTitle' => 'Users',
            'pageDesc' => 'In this page, we will get the all users information.',
        ]);
    }
}
