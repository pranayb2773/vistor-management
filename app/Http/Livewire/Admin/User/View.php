<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use LivewireUI\Modal\ModalComponent;

class View extends ModalComponent
{
    public User $user;

    public function mount(User $user): void
    {
        $this->user = $user->load(['roles' => ['permissions']]);
    }

    public function render(): Application|Factory|\Illuminate\View\View
    {
        return view('livewire.admin.user.view');
    }
}
