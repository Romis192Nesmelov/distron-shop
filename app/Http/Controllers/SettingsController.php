<?php

namespace App\Http\Controllers;

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

    // Settings
    public function getSettings(): array
    {
        return (array)$this->xml->settings;
    }

    public function saveSettings(array $fields): void
    {
        $this->xml->settings->video = $fields['video'];
        $this->xml->asXML($this->pathToXML);
    }
}
