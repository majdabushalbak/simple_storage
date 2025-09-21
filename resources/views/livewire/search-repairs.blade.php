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

    <div class="custom-pagination">
    @if ($repairs->onFirstPage())
        <span class="page disabled">&laquo; Prev</span>
    @else
        <a href="{{ $repairs->previousPageUrl() }}" class="page">&laquo; Prev</a>
    @endif

    @foreach ($repairs->getUrlRange(1, $repairs->lastPage()) as $page => $url)
        @if ($page == $repairs->currentPage())
            <span class="page active">{{ $page }}</span>
        @else
            <a href="{{ $url }}" class="page">{{ $page }}</a>
        @endif
    @endforeach

    @if ($repairs->hasMorePages())
        <a href="{{ $repairs->nextPageUrl() }}" class="page">Next &raquo;</a>
    @else
        <span class="page disabled">Next &raquo;</span>
    @endif
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
                        <tr>
                            <td>{{ $repair->car_id }}</td>
                            <td>{{ $repair->type ?? '-' }}</td>
                            <td>{{ $repair->name ?? '-' }}</td>
                            <td>{{ $repair->phone ?? '-' }}</td>
                            <td>
                                <span class="dropdown">
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
