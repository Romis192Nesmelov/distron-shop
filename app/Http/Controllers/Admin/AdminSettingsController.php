<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Http\Controllers\SettingsController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSettingsController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function settings(): View
    {
        $this->data['menu_key'] = 'settings';
        $settings = new SettingsController();
        $this->data['seo'] = $settings->getSeoTags();
        $this->data['metas'] = $this->metas;
        $this->data['settings'] = $settings->getSettings();
        return $this->showView('settings');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editSettings(Request $request): RedirectResponse
    {
        $validationArr = ['video' => $this->validationString, 'title' => $this->validationString];
        foreach ($this->metas as $meta => $params) {
            $validationArr[$meta] = 'nullable|min:3|max:255';
        }
        $fields = $this->validate($request, $validationArr);
        $settings = new SettingsController();
        $settings->saveSettings($fields);
        $this->saveCompleteMessage();
        return redirect(route('admin.settings'));
    }
}
