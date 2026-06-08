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

    /**
     * Vendor confirms a pending reservation (pending -> confirmed).
     * The listing stays 'reserved' until pickup is completed.
     */
    public function confirm(string $id)
    {
        $reservation = $this->vendorReservation($id);

        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Only pending reservations can be confirmed.');
        }

        $reservation->update(['status' => 'confirmed']);

        return back()->with('success', 'Reservation confirmed. The buyer can now collect the food.');
    }

    /**
     * Vendor marks a reservation as completed once the buyer has picked up
     * (pending/confirmed -> completed) and the listing is closed as 'claimed'.
     */
    public function complete(string $id)
    {
        $reservation = $this->vendorReservation($id);

        if (! in_array($reservation->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'This reservation can no longer be completed.');
        }

        $reservation->update(['status' => 'completed']);
        $reservation->listing->update(['status' => 'claimed']);

        return back()->with('success', 'Reservation marked as completed.');
    }

    /**
     * Fetch a reservation and ensure its listing belongs to the current vendor.
     */
    protected function vendorReservation(string $id): Reservation
    {
        $reservation = Reservation::with('listing')->findOrFail($id);

        abort_unless($reservation->listing->vendor_id === Auth::id(), 403);

        return $reservation;
    }
}
