@extends('layouts.app')

@section('content')

<link href="{{ asset('css/secandary-pages.css') }}" rel="stylesheet">

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
