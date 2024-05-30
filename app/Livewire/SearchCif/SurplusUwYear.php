<?php

namespace App\Livewire\SearchCif;

use Livewire\Component;

class SurplusUwYear extends Component
{
    public function boot()
    {
    }

    public function mount()
    {
        \setPageTitle('Search CIF (Surplus UW Year)');
    }

    public function render()
    {
        return view('livewire.search-cif.surplus-uw-year');
    }
}
