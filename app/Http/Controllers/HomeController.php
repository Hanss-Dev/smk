<?php

namespace App\Http\Controllers;

use App\Models\Highlight;
use App\Models\News;
use App\Models\Popup;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $highlights = Highlight::where('is_active', true)->orderBy('id', 'desc')->get();
        $popup = Popup::where('is_active', true)->orderBy('id', 'desc')->first();
        $news = News::where('status', 'publish')->orderBy('created_at', 'desc')->limit(6)->get();

        return view('index', compact('highlights', 'popup', 'news'));
    }
}
