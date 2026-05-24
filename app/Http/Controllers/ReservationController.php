<?php

namespace App\Http\Controllers;

use App\Models\FoodListing;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, string $listingId)
    {
        $listing = FoodListing::where('status', 'available')->findOrFail($listingId);

        $alreadyReserved = Reservation::where('listing_id', $listingId)
            ->where('buyer_id', Auth::id())
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($alreadyReserved) {
            return back()->with('error', 'You have already reserved this item.');
        }

        Reservation::create([
            'listing_id'  => $listing->id,
            'buyer_id'    => Auth::id(),
            'status'      => 'pending',
            'reserved_at' => now(),
        ]);

        $listing->update(['status' => 'reserved']);

        return redirect()->route('buyer.reservations')->with('success', 'Reservation placed successfully.');
    }

    public function cancel(string $id)
    {
        $reservation = Reservation::where('buyer_id', Auth::id())->findOrFail($id);
        $reservation->update(['status' => 'cancelled']);
        $reservation->listing->update(['status' => 'available']);

        return back()->with('success', 'Reservation cancelled.');
    }
}
