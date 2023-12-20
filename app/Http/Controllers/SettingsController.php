<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{
    use HelperTrait;

    private $xml;

    public function __construct()
    {
        $this->xml = simplexml_load_file(base_path(env('SETTINGS_XML')));
    }

    // Seo
    public function getSeoTags(): array
    {
        $seo = (array)$this->xml->seo;
        $tags = ['title' => $seo['title']];
        foreach ($this->metas as $meta => $params) {
            $tags[$meta] = (string)$this->xml->seo->$meta;
        }
        return $tags;
    }

    // Settings
    public function getSettings(): array
    {
        return (array)$this->xml->settings;
    }
}
