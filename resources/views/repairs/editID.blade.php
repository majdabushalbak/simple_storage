@extends('layouts.app')

@section('content')
<div class="container max-w-lg mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center">تعديل رقم السيارة</h1>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('repairs.updateID', $repair->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="car_id" class="block font-semibold mb-1">رقم السيارة</label>
            <input type="text" name="car_id" id="car_id" value="{{ old('car_id', $repair->car_id) }}"
                   required class="w-full border rounded p-2">
        </div>

        <div>
            <label for="name" class="block font-semibold mb-1">الاسم</label>
            <input type="text" name="name" id="name" value="{{ old('name', $repair->name) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label for="phone" class="block font-semibold mb-1">الهاتف</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $repair->phone) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label for="type" class="block font-semibold mb-1">النوع</label>
            <input type="text" name="type" id="type" value="{{ old('type', $repair->type) }}" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full">
            حفظ التغييرات
        </button>
    </form>
</div>
@endsection
