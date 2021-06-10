<?php

use app\models\Rbac;
use yii\db\Migration;

/**
 * Class m210607_111249_rbac_init
 */
class m210607_111249_rbac_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        # init base rbac migrations
        Yii::$app->runAction('migrate/up', ['migrationPath' => '@yii/rbac/migrations', 'interactive' => false]);

        # create first user as admin
        $this->insert('{{%user}}', [
            'id' => 1,
            'login' => 'admin',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'updated_at' => time(),
            'created_at' => time(),
        ]);

        $authManager = Yii::$app->authManager;
        $authManager->removeAll();

        // Default roles
        $role_admin = $authManager->createRole(Rbac::ROLE_ADMIN);
        $role_user = $authManager->createRole(Rbac::ROLE_USER);
        $role_guest = $authManager->createRole(Rbac::ROLE_GUEST);


        // Create roles and inherit
        $authManager->add($role_admin);
        $authManager->add($role_user);
        $authManager->add($role_guest);
        $authManager->addChild($role_user, $role_guest);
        $authManager->addChild($role_admin, $role_user);

        // Set role admin for user with id 1
        $authManager->assign($role_admin, 1);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210607_111249_rbac_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210607_111249_rbac_init cannot be reverted.\n";

        return false;
    }
    */
}
