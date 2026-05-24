@extends('layouts.app')

@section('title', 'Edit Listing')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
            <div>
                <h1 class="page-heading">Edit Listing</h1>
                <p class="page-subheading">Update details for <strong>{{ $listing->title }}</strong></p>
            </div>
            <a href="{{ route('vendor.listings.index') }}" class="btn btn-outline-secondary btn-sm align-self-start">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="card p-4" style="border-radius:16px;">
            <form method="POST" action="{{ route('vendor.listings.update', $listing) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Food Item Title <span style="color:var(--danger);">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $listing->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $listing->description) }}</textarea>
                </div>

                <hr class="amber-divider">

                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Quantity <span style="color:var(--danger);">*</span></label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $listing->quantity) }}" min="0" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Price (RM) <span style="color:var(--danger);">*</span></label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $listing->price) }}" min="0" step="0.01" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">— None —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $listing->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status <span style="color:var(--danger);">*</span></label>
                        <select name="status" class="form-select" required>
                            @foreach(['available','reserved','claimed','expired'] as $s)
                                <option value="{{ $s }}" {{ old('status', $listing->status) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pickup Location <span style="color:var(--danger);">*</span></label>
                    <input type="text" name="pickup_location" class="form-control"
                           value="{{ old('pickup_location', $listing->pickup_location) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Expiry Date & Time</label>
                    <input type="datetime-local" name="expiry_time" class="form-control"
                           value="{{ old('expiry_time', $listing->expiry_time?->format('Y-m-d\TH:i')) }}">
                </div>

                @if($listing->image)
                    <div class="mb-3">
                        <label class="form-label">Current Photo</label>
                        <div>
                            <img src="{{ asset('storage/' . $listing->image) }}" alt="current"
                                 style="max-height:160px;border-radius:10px;border:1px solid var(--border);">
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <label class="form-label">{{ $listing->image ? 'Replace Photo' : 'Add Photo' }}</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div style="font-size:.75rem;color:var(--muted);margin-top:.4rem;">Leave blank to keep current photo.</div>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-primary" style="padding:.65rem 1.75rem;">
                        <i class="bi bi-check-lg me-1"></i> Save Changes
                    </button>
                    <a href="{{ route('vendor.listings.index') }}" class="btn btn-outline-secondary" style="padding:.65rem 1.25rem;">Cancel</a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
