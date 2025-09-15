<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Repair;

class SearchRepairs extends Component
{
    public $car_id = '';

    public function render()
    {
        // If car_id is empty, show all repairs
        $repairs = Repair::when($this->car_id != '', function($query) {
            $query->where('car_id', $this->car_id);
        })->latest()->get();

        return view('livewire.search-repairs', compact('repairs'));
    }
}
