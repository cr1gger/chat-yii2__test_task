<?php

namespace app\controllers;

use app\models\Messages;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;

class SiteController extends Controller
{
    CONST
        API_OK = 1,
        API_FAIL = 0;
    public function actionIndex()
    {
        $messages = Messages::find()->orderBy(['created_at' => SORT_ASC])->limit(Messages::RENDER_COUNT)->all();
        return $this->render('index', compact('messages'));
    }
    public function actionMessageSend()
    {
        if (Yii::$app->request->isPost && !Yii::$app->user->isGuest && Yii::$app->request->isAjax)
        {
            $data = Yii::$app->request->post();
            if (!Yii::$app->user->can('user'))
            {
                return $this->asJson([
                    'status' => self::API_FAIL,
                    'message' => 'Вы зарегистрированный гость, и не можете писать сообщения =('
                ]);
            }
            if (empty($data['message']) || strlen($data['message']) <= 1)
            {
                return $this->asJson([
                    'status' => self::API_FAIL,
                    'message' => 'Невозможно отправить пустое сообщение!'
                ]);
            }

            $messages = new Messages();
            $messages->owner_id = Yii::$app->user->identity->id;
            $messages->message = Html::encode($data['message']);
            $messages->incorrect = Messages::MESSAGE_CORRECT;
            $messages->save();

            return $this->asJson([
                'status' => self::API_OK,
            ]);
        }
        return $this->asJson([
            'status' => self::API_FAIL,
            'message' => 'Для отправки сообщений нужно авторизоваться!'
        ]);
    }
}
