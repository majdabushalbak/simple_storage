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

        <div>
            <label for="car_id" class="block font-semibold mb-1">رقم السيارة</label>
            <input type="text" id="car_id" name="car_id"
                   value="{{ old('car_id') }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div>
            <label for="name" class="block font-semibold mb-1">الاسم</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name') }}"
                   class="w-full border rounded p-2">
        </div>

        <div>
            <label for="phone" class="block font-semibold mb-1">رقم الهاتف</label>
            <input type="text" id="phone" name="phone"
                   value="{{ old('phone') }}"
                   class="w-full border rounded p-2">
        </div>

        <div>
            <label for="type" class="block font-semibold mb-1">النوع</label>
            <input type="text" id="type" name="type"
                   value="{{ old('type') }}"
                   class="w-full border rounded p-2">
        </div>

        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition w-full">
            إضافة إصلاح
        </button>
    </form>
</div>
@endsection
