<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject(trans('auth.confirm_your_email_address'))
                ->line(trans('auth.press_the_button_below_to_confirm_your_email'))
                ->action(trans('auth.confirm_email'), $url);
        });

        ResetPassword::toMailUsing(function (User $user, string $token) {
            return (new MailMessage)
                ->subject(trans('auth.notice_about_reset_password'))
                ->line(trans('auth.you_are_receiving_this_email_because_we_have_received_a_request_to_reset_your_account_password'))
                ->action(trans('auth.reset_the_password'), route('password.reset',['token' => $token]))
                ->line(trans('auth.this_password_reset_link_will_expire_in',['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
                ->line(trans('auth.if_you_did_not_request_a_password_reset_no_further_action_is_required'));
        });
    }
}
