<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FoodListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:vendor']);
    }

    public function index()
    {
        $listings = Auth::user()->foodListings()->with('category')->latest()->paginate(10);
        return view('vendor.index', compact('listings'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('vendor.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'quantity'        => 'required|integer|min:1',
            'price'           => 'required|numeric|min:0',
            'category_id'     => 'nullable|exists:categories,id',
            'pickup_location' => 'required|string|max:500',
            'expiry_time'     => 'nullable|date|after:now',
            'image'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('listings', 'public');
        }

        $data['vendor_id'] = Auth::id();
        FoodListing::create($data);

        return redirect()->route('vendor.listings.index')->with('success', 'Food listing created successfully.');
    }

    public function show(string $id)
    {
        $listing = Auth::user()->foodListings()->with(['category', 'reservations.buyer'])->findOrFail($id);
        return view('vendor.show', compact('listing'));
    }

    public function edit(string $id)
    {
        $listing    = Auth::user()->foodListings()->findOrFail($id);
        $categories = Category::all();
        return view('vendor.edit', compact('listing', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $listing = Auth::user()->foodListings()->findOrFail($id);

        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'quantity'        => 'required|integer|min:0',
            'price'           => 'required|numeric|min:0',
            'category_id'     => 'nullable|exists:categories,id',
            'pickup_location' => 'required|string|max:500',
            'expiry_time'     => 'nullable|date',
            'status'          => 'required|in:available,reserved,claimed,expired',
            'image'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($listing->image) {
                Storage::disk('public')->delete($listing->image);
            }
            $data['image'] = $request->file('image')->store('listings', 'public');
        }

        $listing->update($data);

        return redirect()->route('vendor.listings.index')->with('success', 'Listing updated successfully.');
    }

    public function destroy(string $id)
    {
        $listing = Auth::user()->foodListings()->findOrFail($id);

        if ($listing->image) {
            Storage::disk('public')->delete($listing->image);
        }

        $listing->delete();

        return redirect()->route('vendor.listings.index')->with('success', 'Listing deleted.');
    }
}
