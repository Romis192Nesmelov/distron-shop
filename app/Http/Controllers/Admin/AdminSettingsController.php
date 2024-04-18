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

    public SettingsController $settings;

    public function __construct(SettingsController $settings)
    {
        parent::__construct();
        $this->settings = $settings;
    }

    public function settings(): View
    {
        $this->data['menu_key'] = 'settings';
        $this->data['settings'] = $this->settings->getSettings();
        return $this->showView('settings');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editSettings(Request $request): RedirectResponse
    {
        $fields = $this->validate($request, ['video' => $this->validationString]);
        $this->settings->saveSettings($fields);

        $this->saveCompleteMessage();
        return redirect(route('admin.settings'));
    }
}
