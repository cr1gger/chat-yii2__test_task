<?php


namespace app\controllers;


use app\models\Messages;
use app\models\Rbac;
use app\models\rbac\AuthAssignment;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [Rbac::ROLE_ADMIN],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect(['auth/login']);
                }
            ],
        ];
    }
    public function actionUsers()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('users', compact('dataProvider'));
    }
    public function actionMessages()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Messages::find()->where(['incorrect' => Messages::MESSAGE_INCORRECT]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('messages', compact('dataProvider'));
    }
    public function actionChangeRole()
    {
        if (Yii::$app->request->isPost && Yii::$app->request->isAjax)
        {
            $data = Yii::$app->request->post();
            $userRole = AuthAssignment::find()->where(['user_id' => $data['user_id']])->one();
            if ($userRole)
            {
                $userRole->item_name = $data['value'];
                if($userRole->save()) return $this->asJson([
                        'status' => 1,
                        'message' => 'Группа успешно изменена!'
                    ]);
                else return $this->asJson([
                    'status' => 0,
                    'message' => 'Не удалось сохранить изменения...'
                ]);
            } else return $this->asJson([
                'status' => 0,
                'message' => 'Пользователя не существует =('
            ]);

        } else return $this->redirect(['admin/users']);
    }
    public function actionReturnMessage($message_id)
    {
        $message = Messages::findOne($message_id);
        $message->incorrect = Messages::MESSAGE_CORRECT;
        $message->save();
        return $this->redirect(['admin/messages']);
    }
    public function actionIncorrectMessage($message_id)
    {
        $message = Messages::findOne($message_id);
        $message->incorrect = Messages::MESSAGE_INCORRECT;
        $message->save();
        return $this->redirect(['site/index']);
    }
}