<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Page;

class FrontendController extends Controller
{
    //main home
    public function index()
    { 
        if (setting('main_page')) {
            $page = Page::findOrFail(setting('main_page'));
            return view('home.index', compact('page'));
        }
        return view('home.default');
    }

    //show blog pages
    public function showblog($slug)
    {
        $setting = '';
        $blog = Blog::where('slug', '=', $slug)->first();
        if (!$blog) {
            abort(404);
        }
        return view('blog.show',compact('blog', 'setting'));

    }

    //show blog pages
    public function showpage($slug)
    {
        $setting = '';
        $page = Page::where('slug', '=', $slug)->first();
        if (!$page) {
            abort(404);
        }
        return view('page.show', compact('page', 'setting'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        dd($category);
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        dd($page);
    }

    public function post($slug)
    {
        $post = Blog::where('slug', $slug)->first();
        dd($post);
    }
}
