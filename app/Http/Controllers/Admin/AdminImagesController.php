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

    public Image $image;

    public function __construct(Image $image)
    {
        parent::__construct();
        $this->image = $image;
    }

    public function images($slug=null): View
    {
        return $this->getSomething($this->image, $slug);
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
            $this->image,
            $validationArr,
            'storage/images/gallery/',
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
        return $this->deleteSomething($request, $this->image);
    }
}
