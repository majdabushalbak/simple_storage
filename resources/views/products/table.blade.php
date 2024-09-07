<table class="table table-striped">
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
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->quantity }}</td>
                <td >
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">عرض</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
