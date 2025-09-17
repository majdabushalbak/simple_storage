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
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Car ID</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Phone</th>
                    <th class="border p-2">Type</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($repairs as $repair)
                    <tr>
                        <td class="border p-2">{{ $repair->car_id }}</td>
                        <td class="border p-2">{{ $repair->name ?? '-' }}</td>
                        <td class="border p-2">{{ $repair->phone ?? '-' }}</td>
                        <td class="border p-2">{{ $repair->type ?? '-' }}</td>
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
            No repairs found.
        </p>
    @endif
</div>
