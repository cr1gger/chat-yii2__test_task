<?php


namespace app\models;


use app\models\rbac\AuthAssignment;
use Yii;

class Rbac extends \yii\base\Model
{
    const // Default rbac roles
        ROLE_ADMIN = 'admin',
        ROLE_USER = 'user',
        ROLE_GUEST = 'guest';

    public static function setRole(User $user, $role)
    {
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRole($role);
        if ($role)
        {
            return $authManager->assign($role, $user->id);
        } else return false;
    }
    public static function getRoleByUserId($user_id)
    {
        $result = AuthAssignment::find()->where(['user_id' => $user_id])->one();
        if ($result) return $result->item_name;
    }

    // Далее дополнительная реализация класса, если нужно
}