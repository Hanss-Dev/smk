<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Highlight;
use App\Models\Keungulan;
use App\Models\News;
use App\Models\Popup;
use App\Models\PageSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $highlights   = Highlight::where('is_active', true)->orderBy('id', 'desc')->get();
        $popup        = Popup::where('is_active', true)->orderBy('id', 'desc')->first();
        $news         = News::where('status', 'publish')->orderBy('created_at', 'desc')->limit(6)->get();
        $keunggulan   = Keungulan::where('is_active', true)->orderBy('id', 'asc')->get();
        $alumniList   = Alumni::orderBy('id', 'asc')->get();

        return view('index', compact('highlights', 'popup', 'news', 'keunggulan', 'alumniList'));
    }

    public function podcast()
    {
        $pages = PageSection::where('page_key', PageSection::KEY_PODCAST)->get();
        $sections = $this->parsePageSections($pages);
        return view('podcast', compact('sections'));
    }

    public function lab()
    {
        $pages = PageSection::where('page_key', PageSection::KEY_LAB)->get();
        $sections = $this->parsePageSections($pages);
        return view('lab', compact('sections'));
    }

    public function safetyRiding()
    {
        $pages = PageSection::where('page_key', PageSection::KEY_SAFETY_RIDING)->get();
        $sections = $this->parsePageSections($pages);
        return view('safety-riding', compact('sections'));
    }

    private function parsePageSections($pages)
    {
        $sections = [];
        if ($pages && $pages->isNotEmpty()) {
            foreach ($pages as $page) {
                if (empty($page->content) || !is_array($page->content)) {
                    continue;
                }
                foreach ($page->content as $section) {
                    $rawElements = $section['elemen'] ?? [];
                    
                    $cards = [];
                    $currentCard = [];
                    foreach ($rawElements as $el) {
                        $shouldStartNew = false;
                        if (!empty($currentCard)) {
                            $types = array_column($currentCard, 'type');
                            if ($el['type'] === 'image' && in_array('image', $types)) {
                                $shouldStartNew = true;
                            } elseif ($el['type'] === 'link' && in_array('link', $types)) {
                                $shouldStartNew = true;
                            } elseif ($el['type'] === 'text') {
                                $textCount = 0;
                                foreach ($currentCard as $item) {
                                    if ($item['type'] === 'text') $textCount++;
                                }
                                if ($textCount >= 2) {
                                    $shouldStartNew = true;
                                }
                            }
                        }
                        if ($shouldStartNew) {
                            $cards[] = $currentCard;
                            $currentCard = [];
                        }
                        $currentCard[] = $el;
                    }
                    if (!empty($currentCard)) {
                        $cards[] = $currentCard;
                    }

                    $formattedCards = [];
                    foreach ($cards as $card) {
                        $cardImage = null;
                        $cardLink = null;
                        $cardTexts = [];
                        foreach ($card as $el) {
                            if ($el['type'] === 'image') {
                                $cardImage = $el;
                            } elseif ($el['type'] === 'link') {
                                $cardLink = $el;
                            } else {
                                $cardTexts[] = $el['value'] ?? '';
                            }
                        }
                        $formattedCards[] = [
                            'image' => $cardImage,
                            'link'  => $cardLink,
                            'title' => $cardTexts[0] ?? '',
                            'desc'  => $cardTexts[1] ?? '',
                            'extra_texts' => array_slice($cardTexts, 2)
                        ];
                    }

                    $sections[] = [
                        'nama'  => $section['nama'] ?? '',
                        'cards' => $formattedCards
                    ];
                }
            }
        }
        return $sections;
    }
}
