<table class="table table-striped mb-5">
    <thead>
        <tr>
            <th>اسم القطعة</th>
            <th>الوصف</th>
            <th>الكمية</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>

                    <td class="t-row" onclick="location.href='{{ route('products.show', $product->id) }}'">{{ $product->name }}</td>
                    <td class="t-row" onclick="location.href='{{ route('products.show', $product->id) }}'">{{ $product->description }}</td>
                    <td class="t-row" onclick="location.href='{{ route('products.show', $product->id) }}'">{{ $product->quantity }}</td>

                <td >
                    <div class="dropdown">
                        <button class="dropDownBtn  " style="border-radius: 50% !important;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <ul class="dropdown-menu text-center">
                            <a href="{{ route('products.show', $product->id) }}" class=" dropdown-item">عرض</a>
                            <a href="{{ route('products.edit', $product->id) }}" class=" dropdown-item">تعديل</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"  onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=" dropdown-item text-danger">حذف</button>
                            </form>

                        </ul>
                      </div>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
