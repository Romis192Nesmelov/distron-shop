<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Contact;
use App\Models\Seo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminContactsController extends AdminBaseController
{
    use HelperTrait;

    public Contact $contact;

    public function __construct(Contact $contact)
    {
        parent::__construct();
        $this->contact = $contact;
    }

    public function contacts(): View
    {
        $this->data['seo'] = Seo::find($this->seoIds['contacts']);
        $this->data['metas'] = $this->metas;

        $this->data['types'] = [];
        for ($i=1;$i<=5;$i++) {
            $this->data['types'][] = ['val' => $i, 'descript' => trans('admin.contact_type'.$i)];
        }
        return $this->getSomething($this->contact);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editContactsSeo(Request $request): RedirectResponse
    {
        $seoFields = $this->validate($request, $this->getValidationSeo());
        Seo::where('id',$this->seoIds['contacts'])->update($seoFields);
        $this->saveCompleteMessage();
        return redirect(route('admin.contacts'));
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
            $this->contact,
            ['contact' => $validationContact, 'type' => 'required|integer|min:1|max:5'],
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.contacts'));
    }
}
