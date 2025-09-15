@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Repairs</h1>

        <button
    onclick="window.location='{{ route('repairs.createID') }}'"
    class="bg-blue-600 text-white px-4 py-2 rounded mb-4 hover:bg-blue-700 transition">
    + Add New Repair
</button>


        @livewire('search-repairs')
    </div>
@endsection

@push('scripts')
    <script src="/js/slider-script.js" defer></script>
@endpush
