@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
{{-- Hero --}}
<div style="margin: -2.5rem -12px 0; padding: 5rem 12px 4rem; background: var(--forest); position: relative; overflow: hidden;">
    {{-- Subtle grain texture --}}
    <div style="position:absolute;inset:0;background-image:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22200%22><filter id=%22n%22><feTurbulence type=%22fractalNoise%22 baseFrequency=%220.9%22 numOctaves=%224%22 stitchTiles=%22stitch%22/><feColorMatrix type=%22saturate%22 values=%220%22/></filter><rect width=%22200%22 height=%22200%22 filter=%22url(%23n)%22 opacity=%220.06%22/></svg>');opacity:.4;pointer-events:none;"></div>

    <div class="container" style="position:relative;">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div style="display:inline-block;background:var(--amber);color:var(--dark);font-size:.7rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;padding:.3rem .8rem;border-radius:4px;margin-bottom:1.25rem;">
                    BIIT 2305 · Web Application Development
                </div>
                <h1 style="font-family:'DM Serif Display',serif;font-size:clamp(2.4rem,5vw,3.8rem);color:var(--white);line-height:1.1;margin-bottom:1.25rem;">
                    Less Waste.<br>
                    <em style="color:var(--amber);">More Meals.</em>
                </h1>
                <p style="color:rgba(255,255,255,.7);font-size:1.05rem;max-width:480px;margin-bottom:2rem;line-height:1.7;">
                    FoodSaver connects Malaysian food businesses with people who need affordable food — reducing waste, one listing at a time.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn-amber" style="padding:.75rem 2rem;font-size:1rem;border-radius:10px;text-decoration:none;">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" style="color:rgba(255,255,255,.8);font-size:.95rem;font-weight:500;display:flex;align-items:center;gap:.4rem;text-decoration:none;padding:.75rem 0;">
                        Already have an account <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-end">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;max-width:320px;transform:rotate(2deg);">
                    @foreach([['bi-shop','Vendors','25+ businesses'],['bi-people','Buyers','Save on meals'],['bi-leaf','Eco','Less landfill'],['bi-heart','Halal','Shariah compliant']] as $f)
                    <div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);border-radius:12px;padding:1.2rem;backdrop-filter:blur(4px);">
                        <i class="bi {{ $f[0] }}" style="color:var(--amber);font-size:1.4rem;"></i>
                        <div style="color:var(--white);font-weight:700;font-size:.9rem;margin-top:.5rem;">{{ $f[1] }}</div>
                        <div style="color:rgba(255,255,255,.5);font-size:.75rem;">{{ $f[2] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Amber divider --}}
<hr class="amber-divider" style="margin-top:0;">

{{-- How it works --}}
<div class="mt-5 mb-4">
    <p style="font-size:.75rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--amber);margin-bottom:.5rem;">How it works</p>
    <h2 class="page-heading" style="font-size:2rem;">Simple for everyone.</h2>
</div>

<div class="row g-4 mb-5">
    @foreach([
        ['bi-shop-window','For Vendors','Post surplus food listings in minutes. Set quantity, price, and pickup time. Recover costs, reduce waste, improve your business reputation.','vendor'],
        ['bi-bag-heart','For Buyers','Browse real-time listings from local businesses. Filter by category, reserve your food, and collect at pickup. Affordable meals, zero hassle.','buyer'],
        ['bi-shield-check','For Admins','Monitor platform health, manage users and listings, and ensure content quality. Keep FoodSaver trustworthy and safe for everyone.','admin'],
    ] as [$icon, $title, $desc, $role])
    <div class="col-md-4">
        <div class="card food-card h-100 p-4">
            <div style="width:48px;height:48px;border-radius:12px;background:var(--cream);display:flex;align-items:center;justify-content:center;margin-bottom:1.25rem;border:1px solid var(--border);">
                <i class="bi {{ $icon }}" style="color:var(--forest);font-size:1.3rem;"></i>
            </div>
            <h5 style="font-family:'DM Serif Display',serif;font-size:1.2rem;color:var(--forest);margin-bottom:.6rem;">{{ $title }}</h5>
            <p style="color:var(--muted);font-size:.875rem;line-height:1.65;margin:0;">{{ $desc }}</p>
        </div>
    </div>
    @endforeach
</div>

{{-- Stats strip --}}
<div style="background:var(--forest);border-radius:16px;padding:2.5rem;margin-bottom:3rem;">
    <div class="row text-center g-4">
        @foreach([['17,000','tonnes of food wasted in Malaysia daily'],['4,005','tonnes still edible every day'],['2.9M','people could be fed three meals'],['0','cost to join FoodSaver']] as [$num,$label])
        <div class="col-6 col-md-3">
            <div style="font-family:'DM Serif Display',serif;font-size:2.2rem;color:var(--amber);line-height:1;">{{ $num }}</div>
            <div style="color:rgba(255,255,255,.55);font-size:.78rem;margin-top:.35rem;line-height:1.4;">{{ $label }}</div>
        </div>
        @endforeach
    </div>
</div>

{{-- CTA --}}
<div class="text-center pb-2">
    <h2 class="page-heading" style="font-size:2rem;margin-bottom:.75rem;">Ready to make a difference?</h2>
    <p style="color:var(--muted);margin-bottom:1.75rem;">Join as a vendor or buyer — it's completely free.</p>
    <a href="{{ route('register') }}" class="btn btn-primary" style="padding:.8rem 2.5rem;font-size:1rem;">
        Create your account
    </a>
</div>
@endsection
