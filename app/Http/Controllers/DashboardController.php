<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        return match ($user->role) {
            'vendor' => redirect()->route('vendor.listings.index'),
            'buyer'  => redirect()->route('buyer.listings.index'),
            'admin'  => redirect()->route('admin.dashboard'),
            default  => abort(403),
        };
    }
}
