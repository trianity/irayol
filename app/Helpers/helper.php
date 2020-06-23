<?php 

function module_enabled($alias) { 
    $module=\Module::findByAlias($alias); 
    return (bool) ($module && $module->enabled());
}