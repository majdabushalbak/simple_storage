@extends('layouts.app')

@section('content')

<style>
    :root {
        --gold: hsl(342, 81%, 48%);
        --gold-lite: hsl(342, 81%, 60%);
        --black: #000;
        --white: #fff;
    }

    .gold-btn {
        background-color: var(--gold);
        color: var(--white);
        padding: 0.6rem 1.2rem;
        border-radius: 0.375rem;
        font-weight: bold;
        transition: background-color 0.3s ease;
        width: 100%;
        text-align: center;
    }

    .gold-btn:hover {
        background-color: var(--gold-lite);
    }

    .input-style, .textarea-style, .select-style {
        width: 100%;
        padding: 0.6rem 0.75rem;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        background-color: var(--white);
        color: var(--black);
    }

    .label-style {
        font-weight: 600;
        color: var(--black);
        margin-bottom: 0.25rem;
        display: block;
    }

    .error-box {
        background-color: #fee2e2;
        border: 1px solid #fca5a5;
        color: #b91c1c;
        padding: 0.75rem;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
    }

    .form-container {
        max-width: 640px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 2rem;
        color: var(--gold);
        text-align: start;
    }
</style>

<div class="form-container">
    <h1 class="page-title">إضافة ملاحظة جديدة - السيارة: {{ $repair->car_id }}</h1>

    @if($errors->any())
        <div class="error-box text-sm">
            <ul class="list-disc pl-6">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('repairs.notes.store', $repair->id) }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="note" class="label-style">الملاحظة</label>
            <textarea id="note" name="note" rows="5" class="textarea-style" required>{{ old('note') }}</textarea>
        </div>

        <div>
            <label for="status" class="label-style">الحالة</label>
            <select id="status" name="status" class="select-style" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                <option value="in-progress" {{ old('status') == 'in-progress' ? 'selected' : '' }}>قيد التنفيذ</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
            </select>
        </div>

        <div>
            <label for="cost" class="label-style">التكلفة (بالريال)</label>
            <input type="number" step="0.01" id="cost" name="cost" value="{{ old('cost') }}" class="input-style">
        </div>

        <button type="submit" class="gold-btn">➕ إضافة الملاحظة</button>
    </form>
</div>
@endsection
