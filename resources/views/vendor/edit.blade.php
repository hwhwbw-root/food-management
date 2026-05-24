@extends('layouts.app')

@section('title', 'Edit Listing')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <h4 class="fw-bold mb-4">Edit Listing</h4>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('vendor.listings.update', $listing) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $listing->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $listing->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Quantity *</label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $listing->quantity) }}" min="0" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Price (RM) *</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $listing->price) }}" min="0" step="0.01" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">-- None --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $listing->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            @foreach(['available','reserved','claimed','expired'] as $s)
                                <option value="{{ $s }}" {{ old('status', $listing->status) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pickup Location *</label>
                    <input type="text" name="pickup_location" class="form-control" value="{{ old('pickup_location', $listing->pickup_location) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Expiry Date & Time</label>
                    <input type="datetime-local" name="expiry_time" class="form-control"
                           value="{{ old('expiry_time', $listing->expiry_time?->format('Y-m-d\TH:i')) }}">
                </div>

                @if($listing->image)
                    <div class="mb-3">
                        <label class="form-label">Current Photo</label><br>
                        <img src="{{ asset('storage/' . $listing->image) }}" alt="current" style="max-height:140px;" class="rounded">
                    </div>
                @endif

                <div class="mb-4">
                    <label class="form-label">Replace Photo</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('vendor.listings.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
