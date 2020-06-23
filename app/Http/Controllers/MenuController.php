<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;

class MenuController extends Controller
{
    public function index(){
        $menus = Menu::all();
        return view('menu.index', compact('menus'));
    }

    public function edit($id)
    {
        try {

            $menu = Menu::find($id);
            $pages = Page::all();
            $menuitems = new MenuItem();
            $menus = $menuitems->getall($id);
            $data = ['menus' => $menus, 'indmenu' => $menu, 'pages' => $pages];
            
            return view('menu.edit', $data);
        } catch (Exception $exception) {
            return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }

    }

    public function new($id){

        $menu = Menu::find($id);
        $menuitems = new MenuItem();
        $menu_items = $menuitems->getall($id);

        return view('menu.create', compact('menu', 'menu_items'));
    }

    public function active(Request $request)
    {
        try {
            setting(['main_menu' => $request->main_menu])->save();
            return redirect()->back()->with('success_message', 'Menu was successfully change.');

        } catch (Exception $exception) {
            return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    // POST RUTES
    public function createnewmenu(Request $request)
    {
        $menu = new Menu();
        $menu->name = $request->menu_name;
        $menu->save();
        return redirect()->back();
    }

    public function deleteitemmenu(Request $request)
    {
        $menuitem = MenuItem::findOrFail($request->id);
        $menuitem->delete();
    }

    public function deletemenug(Request $request)
    {
        $menus = new MenuItem();
        $getall = $menus->getall($request->id);
        if (count($getall) == 0) {
            $menudelete = Menu::findOrFail($request->id);
            $menudelete->delete();
            return json_encode(array("resp" => "you delete this item"));
        } else {
            return json_encode(array("resp" => "You have to delete all items first", "error" => 1));
        }
    }

    public function updateitem(Request $request)
    {
        $arraydata = $request->arraydata;
        if (is_array($arraydata)) {
            foreach ($arraydata as $value) {
                $menuitem = MenuItem::find($value['id']);
                $menuitem->label = $value['label'];
                $menuitem->link = $value['link'];
                $menuitem->class = $value['class'];
                $menuitem->save();
            }
        } else {
            $menuitem = MenuItem::find($request->id);
            $menuitem->label = $request->label;
            $menuitem->link = $request->url;
            $menuitem->class = $request->clases;
            $menuitem->save();
        }
    }

    public function addcustommenu()
    {

        $menuitem = new MenuItem();
        $menuitem->label = request()->input("labelmenu");
        $menuitem->link = request()->input("linkmenu");
        if (config('menu.use_roles')) {
            $menuitem->role_id = request()->input("rolemenu") ? request()->input("rolemenu")  : 0 ;
        }
        $menuitem->menu = request()->input("idmenu");
        $menuitem->sort = MenuItem::getNextSortRoot(request()->input("idmenu"));
        $menuitem->save();

    }

    public function generatemenucontrol(Request $request)
    {
        if (is_array($request->arraydata)) {
            foreach ($request->arraydata as $value) {
                $menuitem = MenuItem::find($value["id"]);
                $menuitem->parent = $value["parent"];
                $menuitem->sort = $value["sort"];
                $menuitem->depth = $value["depth"];
                $menuitem->save();
            }
        }
        return json_encode(array("resp" => $menuitem));
    }
}
