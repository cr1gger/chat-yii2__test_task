<?php
/** @var Messages $messages */

use app\models\Messages;
use app\widgets\ChatMessage;

$this->title = 'Чат: Обсуждаем PHP 9';
?>
<div class="uk-container uk-container-xsmall ">
    <div class="uk-flex-center uk-grid-collapse" uk-grid>
        <div class="chat-container uk-width-1-1">
            <?php foreach ($messages as $message): ?>
                <?= ChatMessage::widget(['message' => $message]) ?>
            <?php endforeach; ?>
        </div>
        <div class="uk-width-expand chat-send-message">
                <textarea id="text_area" class="uk-textarea chat-text-area" rows="5"
                          placeholder="Ваше сообщение..."></textarea>
                <button id="submit_message" class="uk-button chat-button uk-flex-right uk-text-right uk-align-right">
                    Отправить
                </button>
        </div>
    </div>
</div>


