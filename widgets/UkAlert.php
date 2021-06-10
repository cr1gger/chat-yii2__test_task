<?php
namespace app\widgets;

use yii\base\Widget;

class UkAlert extends Widget
{
    public $message;
    public $cssClass = 'primary';
    public function run()
    {
        $cssClass = $this->cssClass;
        $message = $this->message;
        if (empty($message)) return;
        return $this->render('uk_alert', compact('cssClass', 'message'));
    }
}