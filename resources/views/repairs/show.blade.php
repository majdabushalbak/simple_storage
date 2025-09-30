@extends('layouts.app')

@section('content')

<link href="{{ asset('css/secandary-pages.css') }}" rel="stylesheet">

<div class="p-2 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-3">تفاصيل السيارة - {{ $repair->car_id }}</h1>
    <br/>



{{-- 🔹 Show car image if exists --}}
<div class="mb-4">
    <label class="label-style">صورة السيارة</label>



     @if($repair->image)
            <div class="mb-3">
                <img src="{{ asset('storage/app/public/' . $repair->image) }}" alt="{{ $repair->name }}" class="img-fluid" style="max-width: 300px;">
            </div>
        @endif

    @else
        <div class="mt-2 text-gray-500 italic">
            لا توجد صورة لهذه السيارة
        </div>
    @endif
</div>




    <a href="{{ route('repairs.notes.create', $repair->id) }}" class="gold-btn">+ إضافة حركة</a>
    <br/><br/>
</div>

<div class="p-2 max-w-3xl mx-auto">
    @if ($repair->notes->count() > 0)
        @foreach ($repair->notes as $note)
            <div class="note-card">
                <div class="note-meta">
                    <div><span class="meta-label">الحالة:</span> {{ $note->status }}</div>
                    <div><span class="meta-label">التكلفة:</span> {{ $note->cost }} شيقل</div>
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
                        <button type="submit" class="delete-button"
                            onclick="return confirm('هل أنت متأكد من حذف هذه الملاحظة؟')">حذف</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-gray-500 mt-2">لا توجد حركات مسجلة لهذه السيارة حتى الآن.</p>
    @endif
</div>
@endsection
