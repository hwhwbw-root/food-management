@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center" style="padding:2rem 0;">
    <div class="col-md-7 col-lg-6">

        <div class="text-center mb-4">
            <i class="bi bi-leaf-fill" style="color:var(--amber);font-size:2rem;"></i>
            <h2 style="font-family:'Bricolage Grotesque',sans-serif;font-size:1.9rem;font-weight:700;color:var(--forest);margin:.4rem 0 .25rem;letter-spacing:-0.02em;">Join FoodSaver.</h2>
            <p style="color:var(--muted);font-size:.875rem;">Create a free account. Takes less than a minute.</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="card p-4" style="border-radius:16px;">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Role selector --}}
                <div class="mb-4">
                    <label class="form-label">I am a</label>
                    <div class="row g-3">
                        @foreach(['vendor' => ['bi-shop','Vendor','I have surplus food to share'],'buyer' => ['bi-bag-heart','Buyer','I\'m looking for affordable food']] as $role => [$icon, $label, $desc])
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="role" id="role_{{ $role }}" value="{{ $role }}" {{ old('role') === $role ? 'checked' : '' }} required>
                            <label for="role_{{ $role }}" class="w-100 text-center p-3" style="border:2px solid var(--border);border-radius:12px;cursor:pointer;transition:all .2s;display:block;">
                                <i class="bi {{ $icon }}" style="font-size:1.5rem;color:var(--forest);display:block;margin-bottom:.4rem;"></i>
                                <div style="font-weight:700;font-size:.9rem;color:var(--dark);">{{ $label }}</div>
                                <div style="font-size:.75rem;color:var(--muted);margin-top:.2rem;">{{ $desc }}</div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <hr class="amber-divider">

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="e.g. Ahmad bin Ali">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="you@example.com">
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Min. 8 characters">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Repeat password">
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <label class="form-label">Phone <span style="color:var(--border);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="01x-xxxxxxx">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Address <span style="color:var(--border);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
                        <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="City, State">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100" style="padding:.7rem;">Create Account</button>
            </form>
        </div>

        <p class="text-center mt-3" style="font-size:.875rem;color:var(--muted);">
            Already have an account? <a href="{{ route('login') }}" style="color:var(--forest);font-weight:700;text-decoration:none;">Login</a>
        </p>
    </div>
</div>

<style>
    .btn-check:checked + label {
        border-color: var(--forest) !important;
        background: #F0FDF4;
    }
</style>
@endsection
