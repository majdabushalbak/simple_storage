@extends('layouts.app')

@section('content')
<div class="container max-w-lg mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center">إضافة إصلاح جديد</h1>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('repairs.storeID') }}" method="POST" class="space-y-4">
        @csrf

      @csrf
    <label for="car_id">Car ID:</label>
    <input type="number" name="car_id" id="car_id" required>
    <button type="submit">Add Car</button>
    </form>
</div>
@endsection
