@extends('layouts.app')
<title dir="rtl">@yield('title', 'show')</title>

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>

        <!-- Display product image if it exists -->
        @if($product->image)
            <div class="mb-3">
                <img src="{{ asset('storage/app/public/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 300px;">
            </div>
        @endif

        <p><strong>الوصف:</strong> {{ $product->description }}</p>

        <!-- Display and update quantity dynamically -->
        <p><strong>الكمية:</strong> <span id="product-quantity">{{ $product->quantity }}</span></p>

        <div class="mb-3">
            <button onclick="updateQuantity(1)" class="btn btn-success">+</button>



            <button onclick="updateQuantity(-1)" class="btn btn-danger">-</button>



        </div>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">عودة <i class="fa-solid fa-backward"></i></a>
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">تعديل</a>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">حذف</button>
        </form>
    </div>

    <script>
        function updateQuantity(change) {
    let quantityElement = document.getElementById('product-quantity');
    let currentQuantity = parseInt(quantityElement.innerText);

    // Check if the current quantity is 0 and the change is -1
    if (currentQuantity === 0 && change < 0) {
        // Prevent further reduction if quantity is already 0
        return;
    }

    // Update the quantity if the above condition is not met
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
        quantityElement.innerText = data.quantity;
    })
    .catch(error => console.error('Error:', error));
}

    </script>
@endsection
