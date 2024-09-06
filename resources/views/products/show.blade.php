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

        <!-- Display and update quantity dynamically -->
        <p><strong>Quantity:</strong> <span id="product-quantity">{{ $product->quantity }}</span></p>

        <div class="mb-3">
            <button onclick="updateQuantity(1)" class="btn btn-success">+</button>


            @if($product->quantity>0)
            <button onclick="updateQuantity(-1)" class="btn btn-danger">-</button>
@endif


        </div>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit Product</a>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Product</button>
        </form>
    </div>

    <script>
        function updateQuantity(change) {
            let currentQuantity = parseInt(document.getElementById('product-quantity').innerText);

            fetch(`/products/{{ $product->id }}/update-quantity`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    quantity: currentQuantity + change
                })
            })
            .then(response => response.json())
            .then(data => {
                // Update the quantity on the page
                document.getElementById('product-quantity').innerText = data.quantity;
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
