<div class="p-4">
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Search by Car ID</label>
        <input wire:model.live="car_id"
               type="number"
               placeholder="Enter car ID"
               class="border rounded p-2 w-full">
    </div>

    @if($repairs->count() > 0)
       <table class="w-full border-collapse border">
    <thead>
        <tr class="bg-gray-100">
            <th class="border p-2">ID</th>
            <th class="border p-2">Car ID</th>
            <th class="border p-2">Created At</th>
            <th class="border p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($repairs as $repair)
            <tr>
                <td class="border p-2">{{ $repair->id }}</td>
                <td class="border p-2">{{ $repair->car_id }}</td>
                <td class="border p-2">{{ $repair->created_at->format('d/m/Y') }}</td>
                <td class="border p-2 space-x-2">
                    <a href="{{ route('repairs.show', $repair->id) }}" class="text-blue-600">Show</a>
                    <a href="{{ route('repairs.editID', $repair->id) }}" class="text-green-600">Edit Car</a>
                    <form action="{{ route('repairs.destroyID', $repair->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    @else
        <p class="text-center text-gray-500 mt-4">
            @if($car_id != '')
                No data found for car ID {{ $car_id }}
            @else
                No repairs available.
            @endif
        </p>
    @endif
</div>
