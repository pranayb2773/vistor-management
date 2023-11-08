<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public function render(): Application|Factory|View
    {
        return view('livewire.admin.dashboard')->layout('layouts.admin', [
            'pageTitle' => 'Dashboard',
            'pageDesc' => 'This is the dashboard page where we get all stats information.',
        ]);
    }
}
