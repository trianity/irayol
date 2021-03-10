<?php

use App\Models\MenuItem;

function module_enabled($alias)
{
    $module = \Module::findByAlias($alias);
    return (bool) ($module && $module->enabled());
}

function menuUrl($menu)
{
    if ($menu->source == 'custom') :
        return $menu->url ?? '#!';

    elseif ($menu->source == 'category') :
        return route('site.category', ['slug' => $menu->category->slug]);

    elseif ($menu->source == 'page') :

        return route('page.show', ['slug' => $menu->page->slug]);

    elseif ($menu->source == 'post') :

        return route('blog.show', ['id' => $menu->post->slug]);

    endif;
}

function mainMenu() {
    return MenuItem::tree()->where('menu_id', setting('main_menu'));
}