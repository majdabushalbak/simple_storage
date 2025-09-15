@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Car ID</h1>

    <form action="{{ route('repairs.updateID', $repair->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="car_id" class="form-label">Car ID</label>
            <input type="number" name="car_id" id="car_id" value="{{ old('car_id', $repair->car_id) }}" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Car</button>
    </form>
</div>
@endsection
