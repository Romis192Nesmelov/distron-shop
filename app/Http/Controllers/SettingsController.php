<?php

namespace App\Http\Controllers;

use PhpParser\Node\Expr\Cast\Object_;

class SettingsController extends Controller
{
    use HelperTrait;

    private Object $xml;
    private string $pathToXML;

    public function __construct()
    {
        $this->pathToXML = base_path(env('SETTINGS_XML'));
        $this->xml = simplexml_load_file($this->pathToXML);
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

    public function saveSettings(array $fields): void
    {
        $this->xml->settings->video = $fields['video'];
        $this->xml->seo->title = $fields['title'];
        foreach ($this->metas as $meta => $params) {
            $this->xml->seo->$meta = $fields[$meta];
        }
        $this->xml->asXML($this->pathToXML);
    }
}
