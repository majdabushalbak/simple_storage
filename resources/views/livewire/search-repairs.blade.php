<div>
     <link href="{{ asset('css/table.css') }}" rel="stylesheet">
<div class="p-4">

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Search</label>
        <input
            wire:model.live="searchValue"
            type="text"
            placeholder="Search"
            class="border rounded p-2 w-full">
    </div>

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
                            <a href="{{ route('repairs.show', $repair->id) }}">Show</a>
                            <a href="{{ route('repairs.editID', $repair->id) }}">Edit</a>
                            <form action="{{ route('repairs.destroyID', $repair->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
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
