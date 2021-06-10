<?php


namespace app\controllers;


use app\models\User;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $alert = [];
        if (!Yii::$app->user->isGuest) return $this->redirect(['site/index']);
        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post();
            $user = User::find()->where(['login' => $data['login']])->one();
            if ($user)
            {
                if($user->validatePassword($data['password'])) {
                    Yii::$app->user->login($user);
                    return $this->redirect(['site/index']);
                }
            }
            $alert = [
                'message' => 'Логин или пароль не верны =(',
                'cssClass' => 'danger'
            ];
        }
        return $this->render('login', compact('alert'));
    }
    public function actionRegister()
    {
        $alert = [];
        if (!Yii::$app->user->isGuest) return $this->redirect(['site/index']);
        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post();
            $user = User::find()->where(['login' => $data['login']])->one();
            if (strlen($data['login']) > 10) {
                $alert = [
                    'message' => 'Логин не может быть длинее 10 символов',
                    'cssClass' => 'danger'
                ];
                goto render;
            }
            if (!$user)
            {
                $user = new User();
                $user->login = Html::encode($data['login']);
                $user->password_hash = Yii::$app->security->generatePasswordHash($data['password']);
                $user->save();
                Yii::$app->user->login($user);
                return $this->redirect(['site/index']);
            } else {
                $alert = [
                    'message' => 'Логин занят',
                    'cssClass' => 'danger'
                ];
            }

        }
        render:
        return $this->render('register', compact('alert'));
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['site/index']);
    }
}