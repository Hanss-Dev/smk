<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class PublicNewsController extends Controller
{
    public function index()
    {
        $newsList = News::where('status', 'publish')->orderBy('id', 'desc')->paginate(12);
        return view('news', compact('newsList'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('news-detail', compact('news'));
    }
}
