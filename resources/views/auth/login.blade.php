@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center" style="min-height:60vh;align-items:center;padding:2rem 0;">
    <div class="col-md-5 col-lg-4">

        <div class="text-center mb-4">
            <i class="bi bi-leaf-fill" style="color:var(--amber);font-size:2rem;"></i>
            <h2 style="font-family:'DM Serif Display',serif;font-size:1.9rem;color:var(--forest);margin:.4rem 0 .25rem;">Welcome back.</h2>
            <p style="color:var(--muted);font-size:.875rem;">Log in to your FoodSaver account</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                @foreach($errors->all() as $error){{ $error }}@endforeach
            </div>
        @endif

        <div class="card p-4" style="border-radius:16px;">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>

                <div class="mb-4 d-flex align-items-center justify-content-between">
                    <div class="form-check mb-0">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember" style="font-size:.85rem;color:var(--muted);text-transform:none;letter-spacing:0;font-weight:500;">Remember me</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100" style="padding:.7rem;">Login</button>
            </form>
        </div>

        <p class="text-center mt-3" style="font-size:.875rem;color:var(--muted);">
            Don't have an account? <a href="{{ route('register') }}" style="color:var(--forest);font-weight:700;text-decoration:none;">Register free</a>
        </p>
    </div>
</div>
@endsection
