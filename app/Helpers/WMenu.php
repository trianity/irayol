<?php

namespace App\Helpers;

class WMenu
{
    public static function select($name = "menu", $menulist = array())
    {
        $html = '<select class="form-control form-control-sm" name="' . $name . '">';
        foreach ($menulist as $key => $val) {
            $active = '';
            if (request()->input('menu') == $key) {
            $active = 'selected="selected"';
            }
            $html .= '<option ' . $active . ' value="' . $key . '">' . $val . '</option>';
        }
        $html .= '</select>';
        return $html;
    }


    /**
    * Returns empty array if menu not found now.
    * Thanks @sovichet
    *
    * @param $name
    * @return array
    */
    public static function getByName($name)
    {
        $menu = Menu::byName($name);
        return is_null($menu) ? [] : self::get($menu->id);
    }

    public static function get($menu_id)
    {
        $menuItem = new MenuItem;
        $menu_list = $menuItem->getall($menu_id);

        $roots = $menu_list->where('menu', (int) $menu_id)->where('parent', 0);

        $items = self::tree($roots, $menu_list);
        return $items;
    }

    private static function tree($items, $all_items)
    {
        $data_arr = array();
        $i = 0;
        foreach ($items as $item) {
            $data_arr[$i] = $item->toArray();
            $find = $all_items->where('parent', $item->id);

            $data_arr[$i]['child'] = array();

            if ($find->count()) {
            $data_arr[$i]['child'] = self::tree($find, $all_items);
            }

            $i++;
        }

        return $data_arr;
    }
}