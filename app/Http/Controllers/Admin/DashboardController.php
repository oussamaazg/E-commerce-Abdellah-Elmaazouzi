<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $allUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalUser = User::where('role', 'user')->count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', $todayDate)->count();
        $thisMonthOrders = Order::WhereMonth('created_at', $thisMonth)->count();
        $thisYearOrders = Order::whereYear('created_at', $thisYear)->count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'allUsers',
            'totalAdmin',
            'totalUser',
            'totalOrders',
            'todayOrders',
            'thisMonthOrders',
            'thisYearOrders'
        ));
    }
}
