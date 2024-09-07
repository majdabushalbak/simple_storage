@extends('layouts.app')
<script src="/js/slider-script.js" defer></script>
@section('content')
<a href="{{ route('products.create') }}" class="btn btn-dark corner m-4 py-3 px-4">
   إضافة قطعة
</a>
    <div class="container py-0">
       

        <!-- Search Form -->
        <form action="{{ route('products.index') }}" method="GET" class="d-flex justify-content-center mb-4">
            <div class="input-group" style="max-width: 500px; position: relative;">
                <input type="search" style="border-radius: 0; outline: none !important;" name="search" id="product-search" class="form-control" placeholder="إبحث عن قطعة ..." autocomplete="off">
                <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>

                <!-- Suggestions dropdown -->
                <ul id="suggestions" class="dropdown-menu w-100" style="display: none;">
                    <!-- Suggestions will be injected here by JavaScript -->
                </ul>
            </div>
        </form>
    </div>
    <div >
        


        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @php
            // Chunk products into groups of 50
            $chunks = $products->chunk(50);
        @endphp

</div>


<div class="wrapper my-5" role="group" aria-label="Categories">
    
    <div class="icon"> <i id="left" class="fa-solid fa-angle-left"></i></div>


 <ul class="tabs-box">
        <!-- All Products Button -->
       
    
        <!-- Category Buttons -->
       @for ($i = 0; $i < $chunks->count(); $i++)

<i class="  tab" onclick="loadTable({{ $i }})">{{ $i + 1 }}</i>
@endfor
    
 </ul>

    <div class="icon"> <i id="right" class="fa-solid fa-angle-right"></i></div>
   
</div>


       <!-- Table Container -->
       <div id="table-container">
        <!-- Initial table content -->
        @include('products.table', ['products' => $chunks->first()])

    </div>
</div>

<script>
    function loadTable(index) {
        const tableContainer = document.getElementById('table-container');

        fetch(`{{ url('products/table/') }}/${index}`)
            .then(response => response.text())
            .then(html => {
                tableContainer.innerHTML = html;
            })
            .catch(error => console.error('Error loading table:', error));
    }
</script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this product?");
        }
    </script>
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
