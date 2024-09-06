@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>

        <!-- Display product image if it exists -->
        @if($product->image)
    <div class="mb-3">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 300px;">
    </div>
@endif

        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit Product</a>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Product</button>
        </form>
    </div>
@endsection
