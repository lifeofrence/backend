<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadershipMember;
use App\Models\GalleryItem;
use App\Models\FinancialReport;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'leadership_count' => LeadershipMember::count(),
            'gallery_count' => GalleryItem::count(),
            'reports_count' => FinancialReport::count(),
            'users_count' => User::count(),
        ];

        $recent_users = User::latest()->take(5)->get();
        $recent_gallery = GalleryItem::latest()->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_gallery'));
    }
}
