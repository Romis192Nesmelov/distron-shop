<a class="mail-block" href="mailto:{{ $email }}">{!! isset($icon) && $icon ? '<i class="'.$icon.(isset($addClass) && $addClass ? ' '.$addClass : '').'"></i> '.$email : $email !!}</a>
