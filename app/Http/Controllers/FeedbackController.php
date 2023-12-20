<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\FeedbackRequest;
use App\Http\Requests\Feedback\FeedbackShortRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function feedback(FeedbackRequest $request): JsonResponse
    {
        return $this->sendMessage('feedback', $request->validated());
    }

    public function feedbackShort(FeedbackShortRequest $request): JsonResponse
    {
        return $this->sendMessage('feedback_short', $request->validated());
    }

    private function sendMessage(string $template, array $fields): JsonResponse
    {
        Mail::send('emails.'.$template, $fields, function($message) {
            $message->subject('Сообщение с сайта '.env('APP_NAME'));
            $message->to(env('MAIL_TO'));
        });
        $message = trans('content.we_will_contact_you');
        return response()->json(['success' => true, 'message' => $message],200);
    }
}
