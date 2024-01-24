<?php

function getItemHead($item): string {
    if (!$item) return '';

    if ($item->type_id == 1) {
        return $item->technology->name;
    } elseif ($item->name) {
        return $item->name;
    } else {
        return $item->type->name;
    }
}

function getItemProps($item): string
{
    if (!$item) return '';

    $props = '';
    foreach (['capacity','voltage','plates'] as $prop) {
        if ($item[$prop]) {
            $props .= trans('content.'.$prop.'_val',['val' => $item[$prop]]).'<br>';
        }
    }
    return $props ? substr($props, 0, -4) : '';
}
