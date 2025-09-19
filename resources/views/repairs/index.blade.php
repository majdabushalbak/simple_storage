@extends('layouts.app')

@section('content')
    <div class="p-6 ">
       

        <button
    onclick="window.location='{{ route('repairs.createID') }}'"
    class="btn btn-dark corner m-4 py-3 px-4">
    إضافة سيارة
</button>


        @livewire('search-repairs')
    </div>
@endsection

@push('scripts')
    <script src="/js/slider-script.js" defer></script>
@endpush
