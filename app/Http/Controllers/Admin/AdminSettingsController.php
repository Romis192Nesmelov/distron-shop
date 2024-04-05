<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Http\Controllers\SettingsController;
use App\Models\Seo;
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
        $this->data['settings'] = $settings->getSettings();

        return $this->showView('settings');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editSettings(Request $request): RedirectResponse
    {
        $fields = $this->validate($request, ['video' => $this->validationString]);

        $settings = new SettingsController();
        $settings->saveSettings($fields);

        $this->saveCompleteMessage();
        return redirect(route('admin.settings'));
    }
}
