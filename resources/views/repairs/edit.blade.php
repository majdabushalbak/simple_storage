@extends('layouts.app')

@section('content')

<link href="{{ asset('css/secandary-pages.css') }}" rel="stylesheet">

<div class="form-container">
    <h1 class="page-title">
        تعديل الحركة: 
    </h1>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="error-box text-sm">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('repairs.notes.update', $note->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="note" class="label-style">الملاحظة</label>
            <textarea id="note" name="note" rows="5" class="textarea-style" required>{{ old('note', $note->note) }}</textarea>
        </div>

        <div>
            <label for="status" class="label-style">الحالة</label>
            <select id="status" name="status" class="select-style" required>
                <option value="pending" {{ old('status', $note->status) == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                <option value="in-progress" {{ old('status', $note->status) == 'in-progress' ? 'selected' : '' }}>قيد التنفيذ</option>
                <option value="completed" {{ old('status', $note->status) == 'completed' ? 'selected' : '' }}>مكتمل</option>
            </select>
        </div>

        <div>
            <label for="cost" class="label-style">التكلفة (شيقل)</label>
            <input type="number" step="0.01" id="cost" name="cost" value="{{ old('cost', $note->cost) }}" class="input-style">
        </div>

        <button type="submit" class="gold-btn mt-3">
            💾 حفظ التغيرات
        </button>
    </form>
</div>
@endsection
