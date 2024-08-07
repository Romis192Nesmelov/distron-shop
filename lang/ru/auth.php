<?php

use Illuminate\Support\Facades\Config;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'login' => 'Вход',
    'enter' => 'Войти',
    'login_register' => 'Вход/Регистрация',
    'register' => 'Зарегистрироваться',
    'logout' => 'Выход',
    'failed' => 'Не верный логин или пароль.',
    'throttle' => 'Слишком много попыток. Пожалуйста, попробуйте через :seconds секунд.',
    'register_subj' => 'Подтверждение регистрации на сайте '.Config::get('app.name'),
    'check_your_mail' => 'Проверьте вашу почту, Вам было отправлено письмо с подтверждением регистрации!',
    'your_account_is_blocked' => 'Ваш аккаунт был заблокирован администрацией!',
    'register_error' => 'Ошибка проверки адреса электронной почты. Вы, возможно, использовали устаревшую ссылку подтверждения регистрации.',
    'get_password' => 'Получить пароль',
    'register_success' => 'Поздравляем, Вы успешно завершили регистрацию!',

    'confirm_register_head' => 'Подтверждение регистрации',
    'confirm_register_part1' => 'Если Вы не регистрировались на нашем сайте, просто игнорируйте это письмо. Если регистрация осуществляется вами, то вы должны подтвердить свою регистрацию и таким образом активировать свою учетную запись.',
    'confirm_register_part2' => 'Для завершения регистрации кликните по следующей ссылке:',

    'send_confirm_mail' => 'Выслать письмо с подтверждением',
    'save_new_password' => 'Сохранить новый пароль',
    'new_password_success' => 'Ваш пароль успещно изменен!',

    'new_user' => 'Новый пользователь',
    'edit_user' => 'Редактирование пользователя',
    'new_user_is_confirm' => 'Подтвержден новый пользователь',

    'address' => 'Адрес',
    'name' => 'Ваше имя',
    'phone' => 'Телефон',
    'email' => 'E-Mail',
    'old_password' => 'Старый пароль',
    'old_password_error' => 'Неверный старый пароль!',
    'password' => 'Пароль',
    'confirm_password' => 'Подтверждение пароля',
    'status' => 'Статус',
    'password_confirm' => 'Повтор пароля',
    'remember_me' => 'Запомнить меня',
    'forgot_your_password' => 'Забыли свой пароль?',
    'forgot_password_text' => 'Если Вы забыли свой пароль, не волнуйтесь! Мы можем легко его восстановить.',
    'send_confirmation_mail_again' => 'Выслать письмо для подтверждения E-mail',
    'confirmation_mail_sent' => 'Письмо с подтверждением<nobr>E-mail выслано Вам повторно',
    'enter_your_email' => 'Введите свой E-mail',
    'confirm_your_email_address' => 'Подтвердите Ваш e-mail адрес',
    'press_the_button_below_to_confirm_your_email' => 'Нажмите кнопку ниже, чтобы подтвердить свой адрес электронной почты.',
    'confirm_email' => 'Подтверждение e-mail',
    'notice_about_reset_password' => 'Уведомление о сбросе пароля',
    'you_are_receiving_this_email_because_we_have_received_a_request_to_reset_your_account_password' => 'Вы получили это письмо, поскольку мы получили запрос на сброс пароля для вашей учетной записи.',
    'reset_the_password' => 'Сбросить пароль',
    'this_password_reset_link_will_expire_in' => 'Срок действия этой ссылки для сброса пароля истекает через :count минут.',
    'if_you_did_not_request_a_password_reset_no_further_action_is_required' => 'Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется.',
    'change_password' => 'Изменение пароля',
    'keep_password' => 'Если вы не хотите менять пароль, то оставте поля «Старый пароль», «Пароль» и «Повтор пароля» не заполненными',
    'login_to_your_account' => 'Войдите в свой аккаунт',
    'login_head' => 'Пожалуйста, войдите,<br> используя свой E-mail и пароль.',
    'register_head' => 'Пожалуйста, заполните все поля и пройдите регистрацию',
    'reset_password' => 'Восстановление пароля',
    'set_password' => 'Установить пароль',
    'thank_you_for_registering' => 'Спасибо за регистрацию!',
    'thank_you_for_registering_on_the_site' => 'Спасибо за регистрацию на сайте :site',
    'go_to_website' => 'Перейти на сайт',

    'new_password' => 'Ваш новый пароль был выслан Вам на почту! Изменить Вы сможете из личного кабинета',
    'reset_password_message' => 'Вы получили это письмо, потому что мы получили запрос на восстановление пароля для вашей учетной записи.',
    'reset_password_ignore_message' => 'Если вы не запрашивали сброс пароля, никаких дополнительных действий не требуется.',
    'your_new_password' => 'Ваш новый пароль: ',

    'user_not_found' => 'Такого пользователя не существует!',
    'user_already_active' => 'Пользователь уже активирован!',
    'wrong_token' => 'Неверный токен!',
    'account' => 'Личный кабинет',

    'capcha-error' => 'Не верная капча!',
];
