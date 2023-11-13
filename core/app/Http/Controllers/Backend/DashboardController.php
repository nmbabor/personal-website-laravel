<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\LinkSubmit;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::where('type','User')->count();

        $todayLink = LinkSubmit::whereDate('created_at',date('Y-m-d'))->count();
        $totalLink = LinkSubmit::count();
        $todayTransections = Order::whereDate('created_at',date('Y-m-d'))->where('is_paid',1)->sum('total_amount');
        $recentOrders = Order::latest()->take(10)->get();
        
        return view('backend.dashboard.index',compact('totalUser','totalLink','todayLink','todayTransections','recentOrders'));
    }
    public function userDashboard()
    {
        $totalTransections = Order::where('user_id',auth()->user()->id)->where('is_paid',1)->sum('total_amount');

        $todayLink = LinkSubmit::where('user_id',auth()->user()->id)->whereDate('created_at',date('Y-m-d'))->count();
        $totalLink = LinkSubmit::where('user_id',auth()->user()->id)->count();
        $todayTransections = Order::where('user_id',auth()->user()->id)->whereDate('created_at',date('Y-m-d'))->where('is_paid',1)->sum('total_amount');
        $recentOrders = Order::where('user_id',auth()->user()->id)->latest()->take(10)->get();
        
        return view('backend.dashboard.userDashboard',compact('totalTransections','totalLink','todayLink','todayTransections','recentOrders'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('backend.profile.index', compact('user'));
    }
}
