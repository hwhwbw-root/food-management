@extends('layouts.app')

@section('title', 'Post Food Listing')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <h4 class="fw-bold mb-4">Post a Food Listing</h4>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('vendor.listings.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Quantity *</label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 1) }}" min="1" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Price (RM) — 0 = Free *</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', 0) }}" min="0" step="0.01" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">-- None --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pickup Location *</label>
                    <input type="text" name="pickup_location" class="form-control" value="{{ old('pickup_location') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Expiry Date & Time</label>
                    <input type="datetime-local" name="expiry_time" class="form-control" value="{{ old('expiry_time') }}">
                </div>

                <div class="mb-4">
                    <label class="form-label">Photo</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Post Listing</button>
                    <a href="{{ route('vendor.listings.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
