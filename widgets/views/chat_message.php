<?php

use app\models\Messages;
use app\models\Rbac;
use app\widgets\AdminDropDown;

$isAdmin = (Rbac::getRoleByUserId($message->owner_id) === Rbac::ROLE_ADMIN) ? 'admin-username' : '';
$isIncorrcet = ($message->incorrect == Messages::MESSAGE_INCORRECT) ? 'incorrect_message' : '';

?>
<div class="chat-body <?=$isIncorrcet?>">
    <div class="chat-message uk-grid-collapse uk-child-width-expand" uk-grid>
        <div class="chat-text uk-width-1-1">
            <span class="chat-username <?=$isAdmin?>"><?=$message->owner->login?></span>
            <?=$message->message?>
        </div>
        <div class="chat-date uk-text-right">
            <?=AdminDropDown::widget(['message_id' => $message->id])?>
            <?=date('d.m.Y - H:i',$message->created_at)?>
        </div>
    </div>
</div>