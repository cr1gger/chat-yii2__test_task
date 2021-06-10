<?php
namespace app\widgets;

use app\models\Rbac;
use Yii;
use yii\base\Widget;

class AdminDropDown extends Widget
{
    public $message_id;
    public function run()
    {
        $message_id = $this->message_id;
        if (Yii::$app->user->can(Rbac::ROLE_ADMIN)){
            return $this->render('admin_drop_down', compact('message_id'));
        } else return '';
    }
}