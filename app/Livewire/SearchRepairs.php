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
                $search = $this->searchValue;
                $query->where(function ($q) use ($search) {
                    $q->where('car_id', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%")
                      ->orWhere('type', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.search-repairs', [
            'repairs' => $repairs,
        ]);
    }
}
