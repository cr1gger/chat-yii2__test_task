<?php

namespace app\controllers;

use app\models\Messages;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {

        $messages = Messages::find()->orderBy(['created_at' => SORT_ASC])->limit(30)->all();
        return $this->render('index', compact('messages'));
    }
    public function actionMessageSend()
    {
        if (Yii::$app->request->isPost && !Yii::$app->user->isGuest && Yii::$app->request->isAjax)
        {
            if (!Yii::$app->user->can('user'))
            {
                return $this->asJson([
                    'status' => 0,
                    'message' => 'Вы зарегистрированный гость, и не можете писать сообщения =('
                ]);
            }
            $data = Yii::$app->request->post();

            $messages = new Messages();
            $messages->owner_id = Yii::$app->user->identity->id;
            $messages->message = Html::encode($data['message']);
            $messages->incorrect = 0;
            $messages->save();

            return $this->asJson([
                'status' => 1,
            ]);
        } else {
            return $this->asJson([
                'status' => 0,
                'message' => 'Для отправки сообщений нужно авторизоваться!'
            ]);
        }
    }
}
