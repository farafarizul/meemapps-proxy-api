<?php

namespace App\Http\Controllers\Webview;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Page;

class WebviewController extends Controller
{
    public function aboutUs()
    {
        $page = Page::where('slug', 'about-us')->where('is_published', true)->first();
        return view('webview.about_us', compact('page'));
    }

    public function contactUs()
    {
        $page = Page::where('slug', 'contact-us')->where('is_published', true)->first();
        $branches = Branch::where('is_active', true)->orderBy('sort_order')->get();
        return view('webview.contact_us', compact('page', 'branches'));
    }

    public function accountClosure()
    {
        $page = Page::where('slug', 'account-closure')->where('is_published', true)->first();
        return view('webview.account_closure', compact('page'));
    }

    public function comingSoon()
    {
        $page = Page::where('slug', 'coming-soon')->where('is_published', true)->first();
        return view('webview.coming_soon', compact('page'));
    }

    public function shariahAdvisor()
    {
        $page = Page::where('slug', 'shariah-advisor')->where('is_published', true)->first();
        return view('webview.shariah_advisor', compact('page'));
    }
}
