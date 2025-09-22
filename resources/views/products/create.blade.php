@extends('layouts.app')
<link href="{{ asset('css/secandary-pages.css') }}" rel="stylesheet">
@section('content')
    <div class="form-container">
        <h1 class="page-title">اضافة قطعة جديد</h1>

        @if($errors->any())
            <div class="error-box">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="label-style">الاسم</label>
                <input type="text" class="input-style" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="label-style">الوصف</label>
                <textarea class="textarea-style" id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="quantity" class="label-style">الكمية</label>
                <input type="number" class="input-style" id="quantity" name="quantity" value="{{ old('quantity') }}">
            </div>

            <div class="mb-3">
                <label for="image" class="label-style">الصورة</label>
                <input type="file" class="input-style" id="image" name="image">
            </div>

            <button type="submit" class="gold-btn">اضافة قطعة</button>
        </form>
    </div>
@endsection

