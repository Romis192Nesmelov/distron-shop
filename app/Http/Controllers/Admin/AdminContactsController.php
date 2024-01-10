<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminContactsController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function contacts(): View
    {
        $this->data['types'] = [];
        for ($i=1;$i<=5;$i++) {
            $this->data['types'][] = ['val' => $i, 'descript' => trans('admin.contact_type'.$i)];
        }
        return $this->getSomething('contacts', new Contact());
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editContact(Request $request): RedirectResponse
    {
        if ($request->type == 2) $validationContact = $this->validationPhone;
        elseif ($request->type == 3) $validationContact = 'required|email';
        elseif ($request->type == 4) $validationContact = 'regex:/^(\<iframe)/';
        else $validationContact = $this->validationString;

            $this->editSomething (
            $request,
            new Contact(),
            ['contact' => $validationContact, 'type' => 'required|integer|min:1|max:5'],
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.contacts'));
    }
}
