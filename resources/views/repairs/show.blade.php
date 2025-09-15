@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Car ID: {{ $repair->car_id }}</h1>

    <div class="p-6">
    <a href="{{ route('repairs.notes.create', $repair->id) }}"
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow mb-4">
       + Add Note
    </a>

    @if($repair->notes->count() > 0)
        <table class="w-full border-collapse border mt-4">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Note</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Cost</th>
                    <th class="border p-2">Created At</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($repair->notes as $note)
                    <tr>
                        <td class="border p-2">{{ $note->note }}</td>
                        <td class="border p-2">{{ $note->status }}</td>
                        <td class="border p-2">{{ $note->cost }}</td>
                        <td class="border p-2">{{ $note->created_at->format('d/m/Y') }}</td>
                        <td class="border p-2 space-x-2">
                            <a href="{{ route('repairs.notes.edit', $note->id) }}" class="text-green-600">Edit</a>
                            <form action="{{ route('repairs.notes.destroy', $note->id) }}" method="POST" class="inline">
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
        <p class="text-gray-500 mt-4">No notes for this car yet.</p>
    @endif
</div>
@endsection
