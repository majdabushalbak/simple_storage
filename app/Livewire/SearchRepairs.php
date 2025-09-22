<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Repair;

class SearchRepairs extends Component
{
    use WithPagination;

    public $searchValue = '';

    // Reset to first page on search
    public function updatingSearchValue()
    {
        $this->resetPage();
    }

    public function render()
    {
        $repairs = Repair::query()
            ->when($this->searchValue !== '', fn($q) =>
                $q->where('car_id', 'like', "%{$this->searchValue}%")
                  ->orWhere('phone', 'like', "%{$this->searchValue}%")
                  ->orWhere('name', 'like', "%{$this->searchValue}%")
                  ->orWhere('type', 'like', "%{$this->searchValue}%")
            )
            ->latest()
            ->paginate(10);

        return view('livewire.search-repairs', compact('repairs'));
    }
}
