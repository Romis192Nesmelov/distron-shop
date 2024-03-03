<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminImagesController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function images($slug=null): View
    {
        return $this->getSomething('images', new Image(), $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editImage(Request $request): RedirectResponse
    {
        $validationArr = [
            'image' => $this->validationJpgAndPng
        ];

        $this->editSomething (
            $request,
            new Image(),
            $validationArr,
            'images/images/',
            'image'
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.images'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteImage(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Image());
    }
}
