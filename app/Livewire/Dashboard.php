<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Dashboard extends Component
{

    public function mount()
    {
        \setPageTitle('Dashboard');
    }

    public function boot()
    {
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
