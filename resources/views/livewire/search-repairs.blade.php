<div>

    <!-- Search Input -->
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Search</label>
        <input
            wire:model.live="searchValue"
            type="text"
            placeholder="Search by رقم السيارة, العميل, الهاتف أو السيارة"
            class="border rounded p-2 w-full">
    </div>

    <div class="custom-pagination-wrapper">
    <div class="custom-pagination">
        {{-- Prev --}}
        @if ($repairs->onFirstPage())
            <span class="page disabled">&laquo; Prev</span>
        @else
            <button wire:click="previousPage" class="page">&laquo; Prev</button>
        @endif

        {{-- Pages --}}
        @php
            $start = max($repairs->currentPage() - 2, 1);
            $end = min($repairs->currentPage() + 2, $repairs->lastPage());
        @endphp

        @for($page = $start; $page <= $end; $page++)
            @if ($page == $repairs->currentPage())
                <span class="page active">{{ $page }}</span>
            @else
                <button wire:click="gotoPage({{ $page }})" class="page">{{ $page }}</button>
            @endif
        @endfor

        {{-- Next --}}
        @if ($repairs->hasMorePages())
            <button wire:click="nextPage" class="page">Next &raquo;</button>
        @else
            <span class="page disabled">Next &raquo;</span>
        @endif
    </div>
</div>



    <!-- Table -->
    <div class="table-responsive shadow-wrapper">
        @if($repairs->count() > 0)
            <table class="contant-table">
                <thead>
                    <tr>
                        <th>رقم السيارة</th>
                        <th>السيارة</th>
                        <th>العميل</th>
                        <th>الهاتف</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($repairs as $repair)


{{-- hiii --}}

    <tr onclick="window.location='{{ route('repairs.show', $repair->id) }}'"
        style="cursor: pointer;">
        <td>{{ $repair->car_id }}</td>
        <td>{{ $repair->type ?? '-' }}</td>
        <td>{{ $repair->name ?? '-' }}</td>
        <td>{{ $repair->phone ?? '-' }}</td>
        <td>
            <span class="dropdown" onclick="event.stopPropagation();">
                <button class="dropDownBtn" style="border-radius: 50% !important;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu text-center">
                    <a href="{{ route('repairs.show', $repair->id) }}" class="dropdown-item">عرض</a>
                    <a href="{{ route('repairs.editID', $repair->id) }}" class="dropdown-item">تعديل</a>
                    <form action="{{ route('repairs.destroyID', $repair->id) }}" method="POST" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="dropdown-item text-danger">حذف</button>
                    </form>
                </ul>
            </span>
        </td>
    </tr>
@endforeach

                </tbody>
            </table>


        @else
            <p>No repairs found.</p>
        @endif
    </div>
</div>
