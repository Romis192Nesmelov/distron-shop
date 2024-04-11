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
                ->subject('Подтвердите Ваш e-mail адрес')
                ->line('Нажмите кнопку ниже, чтобы подтвердить свой адрес электронной почты.')
                ->action('Подтверждение e-mail', $url);
        });

        ResetPassword::toMailUsing(function (User $user, string $token) {
            return (new MailMessage)
                ->subject('Уведомление о сбросе пароля')
                ->line('Вы получили это письмо, поскольку мы получили запрос на сброс пароля для вашей учетной записи.')
                ->action('Сбросить пароль', route('password.reset',['token' => $token]))
                ->line(Lang::get('Срок действия этой ссылки для сброса пароля истекает через :count минут.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
                ->line('Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется.');
        });
    }
}
