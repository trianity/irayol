<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{

    protected $table = null;

    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth', 'role_id'];

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = 'menu_items';
    }

    public function getsons($id)
    {
        return $this->where("parent", $id)->get();
    }
    public function getall($id)
    {
        return $this->where("menu", $id)->orderBy("sort", "asc")->get();
    }

    public static function getNextSortRoot($menu)
    {
        return self::where('menu', $menu)->max('sort') + 1;
    }

    public function parent_menu()
    {
        return $this->belongsTo(Menu::class, 'menu');
    }

    public function child()
    {
        return $this->hasMany(MenuItem::class, 'parent')->orderBy('sort', 'ASC');
    }
}
