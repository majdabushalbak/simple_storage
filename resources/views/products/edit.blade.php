@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Add enctype to handle file uploads -->
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}">
            </div>

            <!-- Image upload section -->
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>

                <!-- Display the current image if one exists -->
                @if($product->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" width="150">
                    </div>
                @endif

                <!-- Input field to upload a new image -->
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-success">Update Product</button>
        </form>
    </div>
@endsection
