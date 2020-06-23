<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalSetting;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Menu;
use Setting;

class FrontendController extends Controller
{
    //main home
    public function index()
    {
        $public_menu = Menu::where('id', setting('main_menu'))->first();

        if (setting('main_page')) {
            $page = Page::findOrFail(setting('main_page'));
            return view('home.index', compact('public_menu', 'page'));
        }
        return view('home.default', compact('public_menu'));
    }

    //show blog pages
    public function showblog($slug)
    {
        $setting = '';
        $blog = Blog::where('slug', '=', $slug)->first();
        $public_menu = Menu::where('id', setting('main_menu'))->first();
        if (!$blog) {
            abort(404);
        }
        return view('blog.show',compact('public_menu', 'blog', 'setting'));

    }

    //show blog pages
    public function showpage($slug)
    {
        $setting = '';
        $page = Page::where('slug', '=', $slug)->first();
        $public_menu = Menu::where('id', setting('main_menu'))->first();
        if (!$page) {
            abort(404);
        }
        return view('page.show', compact('public_menu', 'page', 'setting'));
    }
}
