<?php

namespace App\Http\Controllers;

use App\Models\FoodListing;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalUsers'    => User::count(),
            'vendors'       => User::where('role', 'vendor')->count(),
            'buyers'        => User::where('role', 'buyer')->count(),
            'totalListings' => FoodListing::count(),
            'active'        => FoodListing::where('status', 'available')->count(),
            'reservations'  => Reservation::count(),
        ]);
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function destroyUser(string $id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User removed.');
    }

    public function listings()
    {
        $listings = FoodListing::with(['vendor', 'category'])->latest()->paginate(20);
        return view('admin.listings', compact('listings'));
    }

    public function destroyListing(string $id)
    {
        FoodListing::findOrFail($id)->delete();
        return back()->with('success', 'Listing removed.');
    }
}
