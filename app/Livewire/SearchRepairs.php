<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Repair;

class SearchRepairs extends Component
{
    public $searchValue = '';

    public function render()
    {
        $repairs = Repair::query()
            ->when($this->searchValue !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('car_id', 'like', '%' . $this->searchValue . '%')
                      ->orWhere('phone', 'like', '%' . $this->searchValue . '%')
                      ->orWhere('name', 'like', '%' . $this->searchValue . '%')
                      ->orWhere('type', 'like', '%' . $this->searchValue . '%');
                });
            })
            ->latest()
            ->get();

        return view('livewire.search-repairs', [
            'repairs' => $repairs
        ]);
    }
}
