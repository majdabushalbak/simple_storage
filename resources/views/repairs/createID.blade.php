@extends('layouts.app')

@section('content')
<link href="{{ asset('css/form.css') }}" rel="stylesheet">


<div class="container max-w-lg mx-auto p-6">


    <h1 class="text-xl font-bold mb-6 text-end ">إضافة سيارة</h1>
 <div class="mb-6"><br/></div>
    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="error-box text-sm">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

     <form action="{{ route('repairs.storeID') }}"
          method="POST"
          enctype="multipart/form-data"  {{-- 🔹 Important for image upload --}}
          class="space-y-4">
        @csrf
        <div>
            <label for="car_id" class="label-style"> رقم السيارة
</label>
            <input type="text" id="car_id" name="car_id"
                   value="{{ old('car_id') }}"
                   class="input-style" required>
        </div>
         <div>
            <label for="type" class="label-style">السيارة</label>
            <input type="text" id="type" name="type"
                   value="{{ old('type') }}"
                   class="input-style">
        </div>

        <div>
            <label for="name" class="label-style">العميل</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name') }}"
                   class="input-style">
        </div>

        <div>
            <label for="phone" class="label-style">الهاتف</label>
            <input type="text" id="phone" name="phone"
                   value="{{ old('phone') }}"
                   class="input-style">
        </div>


         {{-- 🔹 Image Upload --}}
        <div>
            <label for="image" class="label-style">صورة السيارة</label>
            <input type="file" id="image" name="image"
                   class="input-style"
                   accept="image/*">
        </div>

        <button type="submit" class="gold-btn w-full py-2 px-5 mt-4 rounded text-center font-semibold">
    إضافة
        </button>
    </form>
</div>
@endsection
