<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FoodListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:buyer']);
    }

    public function index(Request $request)
    {
        $query = FoodListing::with(['vendor', 'category'])
            ->where('status', 'available')
            ->where(function ($q) {
                $q->whereNull('expiry_time')->orWhere('expiry_time', '>', now());
            });

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('pickup_location', 'like', '%' . $request->search . '%');
            });
        }

        $listings   = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('buyer.index', compact('listings', 'categories'));
    }

    public function show(string $id)
    {
        $listing = FoodListing::with(['vendor', 'category'])->where('status', 'available')->findOrFail($id);
        return view('buyer.show', compact('listing'));
    }

    public function myReservations()
    {
        $reservations = Auth::user()->reservations()->with('listing.vendor')->latest()->paginate(10);
        return view('buyer.reservations', compact('reservations'));
    }
}
