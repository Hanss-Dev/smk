<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Highlight;
use App\Models\Popup;
use App\Models\Alumni;
use App\Models\ContentJurusan;
use App\Models\Keungulan;
use App\Models\Pesan;
use App\Models\PageSection;
use App\Models\AdminUser;
use App\Models\User;
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

        // Additional counts for admin overview
        $totalAlumni = Alumni::count();
        $totalContentJurusan = ContentJurusan::count();
        $totalKeungulan = Keungulan::count();
        $totalPesan = Pesan::count();
        $totalPageSection = PageSection::count();
        $totalAdminUser = AdminUser::count();
        $totalUser = User::count();

        return view('admin.dashboard', compact(
            'totalNews',
            'publishNews',
            'draftNews',
            'totalHighlight',
            'totalPopup',
            'totalAlumni',
            'totalContentJurusan',
            'totalKeungulan',
            'totalPesan',
            'totalPageSection',
            'totalAdminUser',
            'totalUser'
        ));
    }
}
