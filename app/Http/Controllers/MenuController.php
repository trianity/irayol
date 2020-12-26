<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;


class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index', compact('menus'));
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|min:2|max:30'
        ]);

        $menu = new Menu();
        $menu->title = $request->title;
        $menu->remark = $request->remark;
        $menu->save();

        return redirect()->back()->with('success', 'Successfully created!');
    }

    public function edit($id)
    {
        $menuId = $id;
        $menuItems          = MenuItem::with(['children'])->where('parent', null)->where('menu_id', $id)->orderBy('order', 'asc')->get();
        $categories         = Category::orderBy('id', 'ASC')->get();
        $pages              = Page::all();
        $posts              = Blog::orderBy('id', 'desc')->get();

        return view('menu.edit', compact('menuItems', 'categories', 'pages', 'posts', 'menuId'));
    }


    public function update(Request $request){
        Validator::make($request->all(), [
            'title'     => 'required|min:2|max:30',
            'menu_id'   => 'required'
        ])->validate();

        $menu = Menu::find($request->menu_id);
        $menu->title = $request->title;
        $menu->remark = $request->remark;
        $menu->save();

        return redirect()->back()->with('success', __('successfully_added'));
    }

    public function destroy(Menu $menu){

    }

    public function active(Request $request)
    {
        try {
            if ($request->main_menu == setting('main_menu')) {
                setting(['main_menu' => ''])->save();
            } else {
                setting(['main_menu' => $request->main_menu])->save();
            }
            
            return redirect()->back()->with('success', 'Menu was successfully change.');
        } catch (\Exception $exception) {
            return back()->withInput()->withErrors(['danger' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
