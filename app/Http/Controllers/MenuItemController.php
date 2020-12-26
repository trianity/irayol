<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class MenuItemController extends Controller
{

    public function menuItem(){

        $menus              = Menu::all();
        $selectedMenu       = Menu::first();
        $categories         = Category::orderBy('id','ASC')->get();
        $menuItems          = MenuItem::with(['children'])->where('parent', null)->where('menu_id', $selectedMenu->id)->orderBy('order', 'asc')->get();
        $pages              = Page::all();
        $posts              = Blog::select('id', 'title')->orderBy('id', 'desc')->get();

        return view('manu.menu_item',['menuItems' => $menuItems, 'menus' => $menus, 'selectedMenus' => $selectedMenu, 'pages' => $pages, 'categories' => $categories, 'posts' => $posts]);
    }

    public function menuItemSearch(Request $request){
        $menuItems = MenuItem::with(['children'])->where('parent', null)->where('menu_id', $request->menu_id)->orderBy('order','ASC')->get();
        $menus              = Menu::all();
        $selectedMenu       = Menu::find($request->menu_id);

        $pages              = Page::all();
        $posts              = Blog::select('id', 'title')->orderBy('id', 'desc')->get();
        $categories         = Category::orderBy('id','ASC')->get();

        return view('menu.menu_item', ['menuItems' => $menuItems, 'menus' => $menus, 'selectedMenus' => $selectedMenu, 'pages' => $pages, 'categories' => $categories, 'posts'=> $posts]);
        }

    public function changeMenuOrder(Request $request)
    {

        $data   = \json_decode($request->data);
        $order  = 0;

        foreach ($data as $value):
            $order++;
            $menu_item    = MenuItem::find($value->id);

            if ($menu_item->source == 'category'):
                MenuItem::where('id', $value->id)->update(array('parent' => null, 'order' => $order));
            else:
                MenuItem::where('id', $value->id)->update(array('parent' => null, 'order' => $order));

                if (!empty($value->children)) :
                    foreach ($value->children as $childValue):
                        $child_menu_item    = MenuItem::find($childValue->id);

                        if ($child_menu_item->source == 'category'):
                            MenuItem::where('id', $childValue->id)->update(array('parent' => null, 'order' => $order));
                        else:
                            MenuItem::where('id', $childValue->id)->update(array('parent' => $value->id, 'order' => $order));

                            if (!empty($childValue->children)) :
                                foreach ($childValue->children as $childChildValue) :
                                    MenuItem::where('id', $childChildValue->id)->update(array('parent' => $childValue->id, 'order' => $order));
                                endforeach;
                            endif;
                        endif;
                    endforeach;
                endif;
            endif;
        endforeach;

        $data['status']     = "success";
        $data['message']    = __('successfully_update_menu_arrangement');

        echo json_encode($data);
    }

    public function menuItemSave(Request $request){
        try {
            $request->validate([
                'source'    => 'required',
                'menu_id'   => 'required'
            ]);

            if ($request->source == 'page') :

                if(!isset($request->page_id)){
                    return redirect()->back()->with('error',__('please_select_at_least_one_item'));
                }

                $page               = Page::find($request->page_id);

                $menuItem           = new MenuItem();
                $menuItem->label    = $page->title;
                $menuItem->url      = $request->page_url;
                $menuItem->menu_id  = $request->menu_id;
                $menuItem->source   = $request->source;
                $menuItem->parent   = null;
                $menuItem->page_id  = $request->page_id;
                $menuItem->status   = 1;
                $menuItem->save();

            elseif ($request->source == 'post') :

                if(!isset($request->post_id)):
                    return redirect()->back()->with('error',__('please_select_at_least_one_item'));
                endif;

                $post               = Blog::find($request->post_id);
                $menuItem           = new MenuItem();
                $menuItem->label    = $post->title;
                $menuItem->url      = $request->post_url;
                $menuItem->menu_id  = $request->menu_id;
                $menuItem->source   = $request->source;
                $menuItem->parent   = null;
                $menuItem->post_id  = $request->post_id;
                $menuItem->status   = 1;

                $menuItem->save();
   

            elseif ($request->source == 'category') :
                if($request->category_id != null):

                    $category               = Category::find($request->category_id);
                                        
                    $menuItem               = new MenuItem();
                    $menuItem->label        = $category->name;
                    $menuItem->url          = $request->category_url;
                    $menuItem->menu_id      = $request->menu_id;
                    $menuItem->source       = $request->source;
                    $menuItem->parent       = null;
                    $menuItem->category_id  = $request->category_id;
                    $menuItem->status       = 1;
                    $menuItem->save();
                else:
                    return redirect()->back()->with('error',__('please_select_at_least_one_item'));
                endif;
            else:
                $menuItem                   = new MenuItem();
                $menuItem->label            = $request->label;
                $menuItem->menu_id          = $request->menu_id;
                $menuItem->source           = $request->source;
                $menuItem->parent           = null;
                $menuItem->url              = $request->url;
                $menuItem->post_id          = $request->post_id;
                $menuItem->page_id          = $request->page_id;
                $menuItem->status           = 1;
                $menuItem->save();
            endif;

            return redirect()->back()->with('success',__('global.successfully_added'));
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', "Error: " . $e->getMessage());
        }
    }

    public function menuItemUpdate(Request $request){
        if(blank($request->label) || blank($request->menu_item_id)){
            return redirect()->back()->with('error', __('not_found'));
        }

        $total_item = count($request->label);
        if(isset($request->url)):
            $total_url  = count($request->url);
        endif;

        $url_position = 0;

        $main_menu = '';
        $sub_menu = '';
        $order = 0;

        for($i=0; $i<$total_item; $i++):
            $order++;

            // for making sub menu
            if ($request->menu_lenght[$i] == 1):
                $main_menu  = $request->menu_item_id[$i];
                $sub_menu   = '';
            elseif ($request->menu_lenght[$i] == 2):
                $sub_menu   = $request->menu_item_id[$i];
            endif;

            $menuItem = MenuItem::find($request->menu_item_id[$i]);
//            dd($request->label[$i+1]);
            $menuItem->label    = $request->label[$i];
            $menuItem->target  = $request->target[$i];

            if(isset($request->url)):
                if($url_position < $total_url):
                    $menuItem->url          = $request->url[$url_position];
                    $url_position++;
                endif;
            endif;

            $menuItem->order    = $order;

             // for making sub menu
            if($request->menu_lenght[$i] == 2):
                $menuItem->parent   = @$main_menu;
            elseif($request->menu_lenght[$i] == 3):
                $menuItem->parent   = @$sub_menu;
            else:
                $menuItem->parent   = null;
            endif;

            $menuItem->save();

        endfor;

        return redirect()->back()->with('success', __('global.successfully_updated'));
    }

    public function menuItemDelete(Request $request){
        $query = MenuItem::where('id', $request->row_id)->with(['children'])->first();

        if ($query->count() > 0) :
            $query->delete();
            $data['status']     = "success";
            $data['message']    =  __('global.successfully_deleted');
        else :
            $data['status']     = "error";
            $data['message']    = __('global.not_found');
        endif;

        echo json_encode($data);
    }

}
