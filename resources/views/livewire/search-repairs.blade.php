<link href="{{ asset('css/table.css') }}" rel="stylesheet">
<div class="p-4">
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Search</label>
        <input
            wire:model.live="searchValue"
            type="text"
            placeholder="Search by Car ID, Phone, Name, or Type"
            class="border rounded p-2 w-full">
    </div>

    @if($repairs->count() > 0)
        <table class="contant-table">
            <thead>
                <tr class="">
                     <th>رقم السيارة</th>  
                     <th>السيارة</th> 
                     <th>العميل</th>         
                     <th>الهاتف</th>
                     <th class=""> </th>
                </tr>
            </thead>
            <tbody>
                @foreach($repairs as $repair)
                    <tr>
                        <td class="">{{ $repair->car_id }}</td>
                        <td class="">{{ $repair->type ?? '-' }}</td>
                        <td class="">{{ $repair->name ?? '-' }}</td>
                        <td class="">{{ $repair->phone ?? '-' }}</td>
                        
                        <td class="">
                            <a href="{{ route('repairs.show', $repair->id) }}" class="">Show</a>
                            <a href="{{ route('repairs.editID', $repair->id) }}" class="">Edit Car</a>
                            <form action="{{ route('repairs.destroyID', $repair->id) }}" method="POST" class="">
                                @csrf
                                @method('DELETE')
                                <button class="" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="">
            No repairs found.
        </p>
    @endif
</div>
