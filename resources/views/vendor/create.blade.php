@extends('layouts.app')

@section('title', 'Post New Listing')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="mb-4">
            <h1 class="page-heading">Post a Listing</h1>
            <p class="page-subheading">Share your surplus food with the community</p>
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
            <form method="POST" action="{{ route('vendor.listings.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Food Item Title <span style="color:var(--danger);">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required
                           placeholder="e.g. Leftover Nasi Lemak (10 packs)">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description <span style="color:var(--border);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
                    <textarea name="description" class="form-control" rows="3"
                              placeholder="Ingredients, condition, packaging details…">{{ old('description') }}</textarea>
                </div>

                <hr class="amber-divider">

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Quantity <span style="color:var(--danger);">*</span></label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 1) }}" min="1" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Price (RM, 0 = Free) <span style="color:var(--danger);">*</span></label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', 0) }}" min="0" step="0.01" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">— None —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pickup Location <span style="color:var(--danger);">*</span></label>
                    <input type="text" name="pickup_location" class="form-control" value="{{ old('pickup_location') }}" required
                           placeholder="e.g. Lot 5, Jalan Ampang, KL">
                </div>

                <div class="mb-3">
                    <label class="form-label">Expiry Date & Time <span style="color:var(--border);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
                    <input type="datetime-local" name="expiry_time" class="form-control" value="{{ old('expiry_time') }}">
                </div>

                <div class="mb-4">
                    <label class="form-label">Photo <span style="color:var(--border);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div style="font-size:.75rem;color:var(--muted);margin-top:.4rem;">JPG, PNG or WebP. Max 2MB.</div>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-primary" style="padding:.65rem 1.75rem;">
                        <i class="bi bi-plus-lg me-1"></i> Post Listing
                    </button>
                    <a href="{{ route('vendor.listings.index') }}" class="btn btn-outline-secondary" style="padding:.65rem 1.25rem;">Cancel</a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
