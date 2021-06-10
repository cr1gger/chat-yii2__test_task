<?php

use yii\helpers\Url;

?>
<button type="button" class="chat-admin-menu">
    <span uk-icon="icon: more; ratio: 1;"></span>
</button>
<div class="chat-admin-dropdown" uk-dropdown="mode: click;pos: bottom-justify" style="opacity:1">
    <ul class="uk-nav uk-dropdown-nav uk-text-center">
        <li><a href="<?=Url::to(['admin/incorrect-message', 'message_id' => $message_id])?>">Некорректное</a></li>
    </ul>
</div>