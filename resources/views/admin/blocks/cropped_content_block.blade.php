<?=mb_substr(strip_tags($croppingContent),0,$length,'UTF-8').(mb_strlen(strip_tags($croppingContent), 'UTF-8') > $length ? '…' : ''); ?>
