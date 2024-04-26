<?php

function getItemHead($item): string {
    if (!$item) return '';

    if (!$item->name && $item->type_id == 1) {
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
    if ($item->type_id == 1) {
        foreach (['capacity','voltage'] as $prop) {
            $props .= trans('content.'.$prop.'_val',['val' => $item[$prop]]).'<br>';
        }
    } else if ($item->type_id == 2) {
        $props .= trans('content.plates_val',['val' => $item['plates']]).'<br>';
        $props .= trans('content.dimensions',['dimensions' => $item->length.'x'.$item->width.'x'.$item->height]).'<br>';
    } else if ($item->type_id == 3) {
        foreach (['section','length','rated_current'] as $prop) {
            if ($item[$prop]) $props .= trans('content.'.$prop.'_val',['val' => $item[$prop]]).'<br>';
        }
    } else {
        if ($item['capacity']) $props .= trans('content.capacity_val',['val' => $item['capacity']]).'<br>';
    }
    return $props ? substr($props, 0, -4) : '';
}
