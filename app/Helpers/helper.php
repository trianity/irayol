<?php

function module_enabled($alias)
{
    $module = \Module::findByAlias($alias);
    return (bool) ($module && $module->enabled());
}

function menuUrl($menu)
{
    if ($menu->source == 'custom') :
        return $menu->url ?? '#';

    elseif ($menu->source   == 'category') :
        return route('site.category', ['slug' => $menu->category->slug]);

    elseif ($menu->source   == 'page') :

        return route('site.page', ['slug' => $menu->page->slug]);

    elseif ($menu->source   == 'post') :

        return route('site.post', ['id' => $menu->post->slug]);

    endif;
}
