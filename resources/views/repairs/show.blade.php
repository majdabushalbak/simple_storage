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
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
    }

    .gold-btn:hover {
        background-color: var(--gold-lite);
    }

    .note-card {
        background-color: var(--white);
        border: 1px solid #ddd;
        border-left: 5px solid var(--gold);
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .note-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    .meta-label {
        font-weight: 600;
        color: var(--black);
    }

    .note-content {
        background-color: #f9f9f9;
        border: 1px solid #eee;
        padding: 1rem;
        border-radius: 0.375rem;
        font-size: 1.05rem;
        line-height: 1.7;
        color: #333;
        white-space: pre-wrap;
        min-height: 100px;
    }

    .note-actions {
        margin-top: 1rem;
        display: flex;
        gap: 1rem;
    }

    .edit-link {
        color: green;
        font-weight: bold;
        text-decoration: none;
    }

    .delete-button {
        color: red;
        background: none;
        border: none;
        font-weight: bold;
        cursor: pointer;
    }
</style>

<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4" style="color: var(--gold);">تفاصيل الإصلاح - رقم السيارة: {{ $repair->car_id }}</h1>

    <a href="{{ route('repairs.notes.create', $repair->id) }}" class="gold-btn mb-6 inline-block">+ إضافة ملاحظة</a>

    @if($repair->notes->count() > 0)
        @foreach($repair->notes as $note)
            <div class="note-card">
                <div class="note-meta">
                    <div><span class="meta-label">الحالة:</span> {{ $note->status }}</div>
                    <div><span class="meta-label">التكلفة:</span> {{ $note->cost }} ريال</div>
                    <div><span class="meta-label">التاريخ:</span> {{ $note->created_at->format('d/m/Y') }}</div>
                </div>

                <div class="note-content">
                    {{ $note->note }}
                </div>

                <div class="note-actions">
                    <a href="{{ route('repairs.notes.edit', $note->id) }}" class="edit-link">تعديل</a>

                    <form action="{{ route('repairs.notes.destroy', $note->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" onclick="return confirm('هل أنت متأكد من حذف هذه الملاحظة؟')">حذف</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-gray-500 mt-6">لا توجد ملاحظات مسجلة لهذا الإصلاح حتى الآن.</p>
    @endif
</div>
@endsection
