<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use App\Jobs\SendMessage;
use Illuminate\Support\Facades\Session;

trait HelperTrait
{
    public string $validationPhone = 'regex:/^((\+)?(\d)(\s)?(\()?[0-9]{3}(\))?(\s)?([0-9]{3})(\-)?([0-9]{2})(\-)?([0-9]{2}))$/';
    public string $validationDate = 'regex:/^(\d{2})\/(\d{2})\/(\d{4})$/';
    public string $validationPassword = 'required|confirmed|min:3|max:50';
    public string $validationInteger = 'required|integer';
    public string $validationString = 'required|min:3|max:255';
    public string $validationText = 'nullable|min:5|max:3000';
    public string $validationSvg = 'mimes:svg|max:10';
    public string $validationJpgAndPng = 'nullable|mimes:jpeg,png|max:2000';
    public string $validationJpg = 'mimes:jpg|max:2000';
    public string $validationPng = 'mimes:png|max:2000';
    public string $validationPdf = 'nullable|mimes:pdf|max:1000';
    public string $validationCsv = 'nullable|mimes:csv,txt|max:1000';
    public string $validationDoc = 'mimes:doc,pdf,docx';

    /**
     * @return string
     */
    public function getValidationDate(): string
    {
        return $this->validationDate;
    }

    private $metas = [
        'meta_description' => ['name' => 'description', 'property' => false],
        'meta_keywords' => ['name' => 'keywords', 'property' => false],
        'meta_twitter_card' => ['name' => 'twitter:card', 'property' => false],
        'meta_twitter_size' => ['name' => 'twitter:size', 'property' => false],
        'meta_twitter_creator' => ['name' => 'twitter:creator', 'property' => false],
        'meta_og_url' => ['name' => false, 'property' => 'og:url'],
        'meta_og_type' => ['name' => false, 'property' => 'og:type'],
        'meta_og_title' => ['name' => false, 'property' => 'og:title'],
        'meta_og_description' => ['name' => false, 'property' => 'og:description'],
        'meta_og_image' => ['name' => false, 'property' => 'og:image'],
        'meta_robots' => ['name' => 'robots', 'property' => false],
        'meta_googlebot' => ['name' => 'googlebot', 'property' => false],
        'meta_google_site_verification' => ['name' => 'google-site-verification', 'property' => false],
    ];

    public function saveCompleteMessage()
    {
        session()->flash('message', trans('admin.save_complete'));
    }

    public function sendMessage(string $template, string $mailTo, string|null $cc, array $fields, string|null $pathToFile=null): JsonResponse
    {
        dispatch(new SendMessage($template, $mailTo, $cc, $fields, $pathToFile));
        $message = trans('content.we_will_contact_you');
        return response()->json(['success' => true, 'message' => $message],200);
    }

    public function getBasketTotal(): int
    {
        $total = 0;
        if (Session::has('basket')) {
            $basket = Session::get('basket');
            foreach ($basket as $id => $position) {
                $total += $position['item']->price * $position['value'];
            }
        }
        return $total;
    }

    public function getPickupAddress(): string
    {
        return Contact::where('type',5)->pluck('contact')->first();
    }

    public function deleteFile($path): void
    {
        if ($path && file_exists(base_path('public/'.$path))) unlink(base_path('public/'.$path));
    }
}
