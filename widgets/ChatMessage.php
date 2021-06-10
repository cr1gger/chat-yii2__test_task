<?php
namespace app\widgets;


use app\models\Messages;
use app\models\Rbac;
use Yii;
use yii\base\Widget;

class ChatMessage extends Widget
{
    public $message;
    public function run()
    {
        $message = $this->message;
        if (($this->message->incorrect == Messages::MESSAGE_INCORRECT) && !Yii::$app->user->can(Rbac::ROLE_ADMIN)) return '';
        return $this->render('chat_message', compact('message'));
    }
}