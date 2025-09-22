<div>
<link href="{{ asset('css/pagination-new.css') }}" rel="stylesheet">
<div class="search-container">
  
   
    <input
      id="search-input"
      wire:model.live="searchValue"
      type="text"
      placeholder="إبحث عن سيارة ..."
      class="search-input"
    >
   <i class="mx-3 fa-solid fa-magnifying-glass"></i>
</div>


   <div class="custom-pagination-wrapper">
    <div class="custom-pagination">
        {{-- Prev --}}
        @if ($repairs->onFirstPage())
            <span class="custom-page custom-arrow is-disabled">&laquo;</span>
        @else
            <button wire:click="previousPage" class="custom-page custom-arrow">&laquo;</button>
        @endif

        {{-- Pages --}}
        @php
            $totalPages = $repairs->lastPage();
            $currentPage = $repairs->currentPage();

            // Always show 5 pages
            $start = max($currentPage - 2, 1);
            $end = $start + 4;

            if ($end > $totalPages) {
                $end = $totalPages;
                $start = max($end - 4, 1);
            }
        @endphp

        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $repairs->currentPage())
                <span class="custom-page is-active">{{ $page }}</span>
            @else
                <button wire:click="gotoPage({{ $page }})" class="custom-page">{{ $page }}</button>
            @endif
        @endfor

        {{-- Next --}}
        @if ($repairs->hasMorePages())
            <button wire:click="nextPage" class="custom-page custom-arrow">&raquo;</button>
        @else
            <span class="custom-page custom-arrow is-disabled">&raquo;</span>
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
