<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Page;
use App\Models\User;
use App\Models\Media;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //----------------------------------------------------------------------Dashboard
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::count();
        $pages = Page::count();
        $blogs = Blog::count();
        $medias = Media::count();
        $categories = Category::count();

        return view('home', compact('users', 'pages', 'blogs', 'medias', 'categories'));
    }

    public function swap($lang)
    {
        // Almacenar el lenguaje en la session
        session()->put('locale', $lang);
        return redirect()->back();
    }

}
