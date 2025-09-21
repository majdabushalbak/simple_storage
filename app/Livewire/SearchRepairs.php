<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Repair;

class SearchRepairs extends Component
{
    use WithPagination;

    // Use Bootstrap styles for pagination
    protected $paginationTheme = 'bootstrap';

    public $searchValue = '';

    // Reset pagination when search input updates
    public function updatingSearchValue()
    {
        $this->resetPage();
    }

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
            ->paginate(10);

        return view('livewire.search-repairs', [
            'repairs' => $repairs
        ]);
    }
}
