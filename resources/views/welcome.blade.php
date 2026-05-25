@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

{{-- Hero: left-aligned split layout, full viewport bleed --}}
<div style="width:100vw;margin-left:calc(50% - 50vw);margin-top:-2.5rem;background:var(--forest);position:relative;overflow:hidden;">

    {{-- Grain texture --}}
    <div style="position:absolute;inset:0;background-image:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22200%22><filter id=%22n%22><feTurbulence type=%22fractalNoise%22 baseFrequency=%220.85%22 numOctaves=%224%22 stitchTiles=%22stitch%22/><feColorMatrix type=%22saturate%22 values=%220%22/></filter><rect width=%22200%22 height=%22200%22 filter=%22url(%23n)%22 opacity=%220.07%22/></svg>');opacity:.5;pointer-events:none;"></div>

    <div class="container" style="position:relative;padding-top:5rem;padding-bottom:5.5rem;">
        <div class="row align-items-center g-5">

            {{-- Left: text content --}}
            <div class="col-lg-6">
                <div style="display:inline-block;background:var(--amber);color:var(--dark);font-size:.68rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;padding:.3rem .9rem;border-radius:4px;margin-bottom:1.5rem;">
                    BIIT 2305 &middot; Web Application Development
                </div>

                <h1 style="font-family:'Bricolage Grotesque',sans-serif;font-size:clamp(2.8rem,5vw,4.4rem);font-weight:800;color:var(--white);line-height:1.05;margin-bottom:1.4rem;text-align:left;letter-spacing:-0.04em;">
                    Less Waste.<br>
                    <span style="color:var(--amber);">More Meals.</span>
                </h1>

                <p style="color:oklch(99.5% 0.003 90 / 0.68);font-size:1rem;max-width:440px;margin-bottom:2.5rem;line-height:1.75;text-align:left;">
                    FoodSaver connects Malaysian food businesses with people who need affordable food, reducing waste one listing at a time.
                </p>

                <div class="d-flex flex-wrap gap-3 align-items-center">
                    <a href="{{ route('register') }}" class="btn-amber" style="padding:.8rem 2.1rem;font-size:.95rem;border-radius:10px;text-decoration:none;">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" style="color:oklch(99.5% 0.003 90 / 0.7);font-size:.9rem;font-weight:500;display:inline-flex;align-items:center;gap:.4rem;text-decoration:none;">
                        Already have an account <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- Right: typographic facts, no cards --}}
            <div class="col-lg-5 offset-lg-1 d-none d-lg-flex flex-column justify-content-center" style="padding-top:1rem;">
                <div style="padding:1.5rem 0;border-bottom:1px solid oklch(99.5% 0.003 90 / 0.12);">
                    <div style="font-family:'Bricolage Grotesque',sans-serif;font-size:3.2rem;font-weight:800;color:var(--white);line-height:1;letter-spacing:-0.04em;">17,000t</div>
                    <div style="color:oklch(99.5% 0.003 90 / 0.55);font-size:.875rem;margin-top:.4rem;line-height:1.5;">food wasted in Malaysia every day</div>
                </div>
                <div style="padding:1.5rem 0;border-bottom:1px solid oklch(99.5% 0.003 90 / 0.12);">
                    <div style="font-family:'Bricolage Grotesque',sans-serif;font-size:3.2rem;font-weight:800;color:var(--amber);line-height:1;letter-spacing:-0.04em;">2.9M</div>
                    <div style="color:oklch(99.5% 0.003 90 / 0.55);font-size:.875rem;margin-top:.4rem;line-height:1.5;">people could be fed three meals daily from that surplus</div>
                </div>
                <div style="padding:1.5rem 0;">
                    <div style="font-family:'Bricolage Grotesque',sans-serif;font-size:3.2rem;font-weight:800;color:var(--white);line-height:1;letter-spacing:-0.04em;">Free</div>
                    <div style="color:oklch(99.5% 0.003 90 / 0.55);font-size:.875rem;margin-top:.4rem;line-height:1.5;">to list surplus or reserve affordable food</div>
                </div>
            </div>

        </div>
    </div>
</div>

<hr class="amber-divider" style="margin-top:0;">

{{-- How it works: zig-zag layout --}}
<div style="padding:3.5rem 0 1rem;">
    <p style="font-size:.72rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:var(--amber);margin-bottom:.5rem;">How it works</p>
    <h2 class="page-heading" style="font-size:2.2rem;margin-bottom:.5rem;">Simple for everyone.</h2>
    <p style="color:var(--muted);font-size:.9rem;max-width:480px;">Three roles, one mission: get surplus food from those who have it to those who need it.</p>
</div>

@php
$featurePanels = [
    0 => ['bg' => 'var(--forest)',  'ic' => 'var(--amber)',  'tc' => 'oklch(99.5% 0.003 90)'],
    1 => ['bg' => 'var(--amber)',   'ic' => 'var(--dark)',   'tc' => 'var(--dark)'],
    2 => ['bg' => 'var(--dark)',    'ic' => 'var(--amber)',  'tc' => 'oklch(99.5% 0.003 90)'],
];
@endphp

@foreach([
    ['bi-shop-window', 'For Vendors', 'Post surplus food listings in minutes. Set quantity, price, and pickup time. Recover costs, reduce waste, and improve your business reputation in the community.', false],
    ['bi-bag-heart',   'For Buyers',  'Browse real-time listings from local businesses. Filter by category, reserve your food, and collect at pickup. Affordable meals, zero hassle.',               true],
    ['bi-shield-check','For Admins',  'Monitor platform health, manage users and listings, and ensure content quality. Keep FoodSaver trustworthy and safe for everyone.',                          false],
] as $idx => [$icon, $title, $desc, $flip])
@php $p = $featurePanels[$idx]; @endphp
<div class="row align-items-center g-4 g-lg-5 mb-5 {{ $flip ? 'flex-lg-row-reverse' : '' }}" style="padding:2rem 0;">
    <div class="col-lg-5">
        <div style="border-radius:14px;background:{{ $p['bg'] }};padding:2.5rem 2.5rem 2rem;min-height:220px;display:flex;flex-direction:column;justify-content:flex-end;">
            <i class="bi {{ $icon }}" style="font-size:3rem;color:{{ $p['ic'] }};margin-bottom:1.1rem;display:block;"></i>
            <div style="font-family:'Bricolage Grotesque',sans-serif;font-weight:700;font-size:1.15rem;color:{{ $p['tc'] }};letter-spacing:-0.01em;">{{ $title }}</div>
        </div>
    </div>
    <div class="col-lg-7 {{ $flip ? 'pe-lg-5' : 'ps-lg-5' }}">
        <h3 style="font-family:'Bricolage Grotesque',sans-serif;font-size:1.9rem;font-weight:700;color:var(--forest);margin-bottom:.75rem;letter-spacing:-0.02em;">{{ $title }}</h3>
        <p style="color:var(--muted);font-size:.95rem;line-height:1.75;margin-bottom:1.5rem;max-width:480px;">{{ $desc }}</p>
        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm" style="padding:.5rem 1.25rem;">
            Get started <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
</div>
@if(!$loop->last)<hr style="border:none;border-top:1px solid var(--border);margin:0;">@endif
@endforeach

{{-- Stats strip --}}
<div style="background:var(--forest);border-radius:16px;padding:3rem 2.5rem;margin:3.5rem 0;">
    <div class="row g-4">
        @foreach([
            ['17,000', 'tonnes of food wasted in Malaysia daily'],
            ['4,005',  'tonnes still edible every day'],
            ['2.9M',   'people could be fed three meals'],
            ['0',      'cost to join FoodSaver'],
        ] as [$num, $label])
        <div class="col-6 col-md-3">
            <div style="font-family:'Bricolage Grotesque',sans-serif;font-weight:800;font-size:2.4rem;color:var(--amber);line-height:1;letter-spacing:-0.03em;">{{ $num }}</div>
            <div style="color:oklch(99.5% 0.003 90 / 0.5);font-size:.78rem;margin-top:.4rem;line-height:1.5;">{{ $label }}</div>
        </div>
        @endforeach
    </div>
</div>

{{-- CTA --}}
<div style="padding:2rem 0 1rem;">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-heading" style="font-size:2rem;margin-bottom:.6rem;">Ready to make a difference?</h2>
            <p style="color:var(--muted);margin:0;">Join as a vendor or buyer. It's completely free. No credit card required.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="{{ route('register') }}" class="btn btn-primary" style="padding:.85rem 2.5rem;font-size:1rem;">
                Create your account
            </a>
        </div>
    </div>
</div>

@endsection
