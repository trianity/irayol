<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    public function __construct(array $attributes = [])
    {
        $this->table = 'menus';
    }

    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class, 'menu')->with('child')->where('parent', 0)->orderBy('sort', 'ASC');
    }

    public function public_menu($id)
    {
        return Menu::find($id);
    }
}
