<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Diploma;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDiplomasController extends AdminBaseController
{
    use HelperTrait;

    public Diploma $diploma;

    public function __construct(Diploma $diploma)
    {
        parent::__construct();
        $this->diploma = $diploma;
    }

    public function diplomas($slug=null): View
    {
        return $this->getSomething($this->diploma, $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editDiploma(Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            $this->diploma,
            [
                'image' => $this->validationJpgAndPng,
                'alt_img' => $this->validationAltImg
            ],
            'storage/images/diplomas/',
            'diploma',
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.diplomas'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteDiploma(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, $this->diploma);
    }
}
