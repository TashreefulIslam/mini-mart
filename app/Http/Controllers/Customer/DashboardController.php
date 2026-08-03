<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalOrders = $user->orders()->count();
        $pending = $user->orders()->where('status', 'Pending')->count();
        $approved = $user->orders()->where('status', 'Approved')->count();
        $delivered = $user->orders()->where('status', 'Delivered')->count();
        $recent = $user->orders()->latest()->take(5)->get();
        return view('customer.dashboard', compact('totalOrders', 'pending', 'approved', 'delivered', 'recent'));
    }
}
