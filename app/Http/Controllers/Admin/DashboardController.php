<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Highlight;
use App\Models\Popup;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNews = News::count();
        $publishNews = News::where('status', 'publish')->count();
        $draftNews = News::where('status', 'draft')->count();
        $totalHighlight = Highlight::count();
        $totalPopup = Popup::count();

        return view('admin.dashboard', compact(
            'totalNews',
            'publishNews',
            'draftNews',
            'totalHighlight',
            'totalPopup'
        ));
    }
}
