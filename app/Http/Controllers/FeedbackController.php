<?php

namespace App\Http\Controllers;
//use App\Http\Requests\Feedback\FeedbackRequest;
use App\Http\Requests\Feedback\FeedbackShortRequest;
use Illuminate\Http\JsonResponse;

class FeedbackController extends Controller
{
    use HelperTrait;

//    public function feedback(FeedbackRequest $request): JsonResponse
//    {
//        return $this->sendMessage('feedback', env('MAIL_TO'), null, $request->validated());
//    }

    public function feedbackShort(FeedbackShortRequest $request): JsonResponse
    {
        return $this->sendMessage('feedback_short', env('MAIL_TO'), null, $request->validated());
    }
}
