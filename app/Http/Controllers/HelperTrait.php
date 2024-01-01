<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
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
    public string $validationJpgAndPng = 'mimes:jpeg,png|max:2000';
    public string $validationJpg = 'mimes:jpg|max:2000';
    public string $validationPng = 'mimes:png|max:2000';
    public string $validationPdf = 'nullable|mimes:pdf|max:1000';
    public string $validationCsv = 'nullable|mimes:csv,txt|max:1000';

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

    public function sendMessage(string $template, string $mailTo, array $fields): JsonResponse
    {
        Mail::send('emails.'.$template, $fields, function($message) use ($mailTo) {
            $message->subject('Сообщение с сайта '.env('APP_NAME'));
            $message->to($mailTo);
        });
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
}
