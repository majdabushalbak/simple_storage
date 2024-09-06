@extends('layouts.app')

@section('content')
    <div class="container py-0">
        <h1 class="text-center">Search Products</h1>

        <!-- Search Form -->
        <form action="{{ route('products.index') }}" method="GET" class="d-flex justify-content-center mb-4">
            <div class="input-group" style="max-width: 500px; position: relative;">
                <input type="search" name="search" id="product-search" class="form-control" placeholder="Search by product name" autocomplete="off">
                <button type="submit" class="btn btn-primary">Search</button>

                <!-- Suggestions dropdown -->
                <ul id="suggestions" class="dropdown-menu w-100" style="display: none;">
                    <!-- Suggestions will be injected here by JavaScript -->
                </ul>
            </div>
        </form>
        {{-- <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create New Product</a> --}}
        <!-- Rest of your table and other HTML content -->
    </div>
    <div class="container">
        <h1>All Products</h1>


        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                            <script>
                                function confirmDelete() {
                                    return confirm("Are you sure you want to delete this product?");
                                }
                            </script>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('product-search');
        const suggestionsList = document.getElementById('suggestions');

        searchInput.addEventListener('input', function() {
    const query = this.value;

    if (query.length > 0) {
        fetch(`{{ route('products.search') }}?query=${query}`)
            .then(response => response.json())
            .then(data => {
                console.log('Received data:', data); // Check this log

                suggestionsList.innerHTML = '';

                if (data.length > 0) {
                    suggestionsList.style.display = 'block';
                    data.forEach(product => {
                        const li = document.createElement('li');
                        li.classList.add('dropdown-item');
                        li.textContent = product;
                        li.addEventListener('click', function() {
                            searchInput.value = this.textContent;
                            suggestionsList.style.display = 'none';
                        });
                        suggestionsList.appendChild(li);
                    });
                } else {
                    suggestionsList.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching products:', error));
    } else {
        suggestionsList.style.display = 'none';
    }
});

        document.addEventListener('click', function(e) {
            if (!suggestionsList.contains(e.target) && e.target !== searchInput) {
                suggestionsList.style.display = 'none';
            }
        });
    });
</script>
@endsection
