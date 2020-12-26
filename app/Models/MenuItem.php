<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [];
    protected $table='menu_item';

    public function menu()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id');
    }

    public function parent()
    {
        return $this->hasOne(static::class, 'id', 'parent')->orderBy('order');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent', 'id')->orderBy('order');
    }

    public static function tree()
    {
        return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent', '=', null)->orderBy('order')->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function Post()
    {
        return $this->belongsTo(Blog::class);
    }

    public function postByCategory()
    {
        return $this->hasMany(Blog::class, 'category_id', 'category_id')->orderBy('id', 'desc')->take(4);
    }
}
