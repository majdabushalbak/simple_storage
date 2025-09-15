@extends('layouts.app')

@section('content')
<div class="container max-w-lg mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center">تعديل الملاحظة للسيارة: {{ $note->repair->car_id }}</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('repairs.notes.update', $note->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="note" class="block font-semibold mb-1">الملاحظة</label>
            <textarea id="note" name="note" class="w-full border rounded p-2">{{ old('note', $note->note) }}</textarea>
        </div>

        <div>
            <label for="status" class="block font-semibold mb-1">الحالة</label>
            <select id="status" name="status" class="w-full border rounded p-2">
                <option value="pending" {{ (old('status', $note->status)=='pending')?'selected':'' }}>قيد الانتظار</option>
                <option value="in-progress" {{ (old('status', $note->status)=='in-progress')?'selected':'' }}>قيد التنفيذ</option>
                <option value="completed" {{ (old('status', $note->status)=='completed')?'selected':'' }}>مكتمل</option>
            </select>
        </div>

        <div>
            <label for="cost" class="block font-semibold mb-1">التكلفة</label>
            <input type="number" step="0.01" id="cost" name="cost" value="{{ old('cost', $note->cost) }}"
                   class="w-full border rounded p-2">
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full">
            حفظ التغييرات
        </button>
    </form>
</div>
@endsection
