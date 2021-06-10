<?php

use app\models\Rbac;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="/favicon.png" type="image/png">
    <?php $this->head() ?>

</head>
<body >
<?php $this->beginBody() ?>




<div class="page">

    <div class="uk-container uk-container-large">
        <header class="">
            <nav class="uk-navbar-container" uk-navbar="mode: click">
                <div class="uk-navbar-center">
                    <ul class="uk-navbar-nav">
                       <li class="chat-logo">
                           <a href="/">
                               Обсуждаем PHP 9
                           </a>
                       </li>
                    </ul>
                </div>

                <div class="uk-navbar-right">

                    <ul class="uk-navbar-nav">
                        <?php if (!Yii::$app->user->isGuest): ?>
                            <li class="kf-dropdown">
                                <a href="#">
                                    <?= Yii::$app->user->identity->login ?> <span uk-icon="chevron-down"></span></a>
                                <div class="uk-navbar-dropdown kf-dropdown-menu">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <?php if(Yii::$app->user->can(Rbac::ROLE_ADMIN)):?>
                                            <li><a href="<?= Url::to(['admin/users']) ?>">Список пользователей</a></li>
                                            <li><a href="<?= Url::to(['admin/messages']) ?>">Некорректные сообщений</a></li>
                                            <hr>
                                        <?php endif;?>
                                        <li><a href="<?= Url::to(['auth/logout']) ?>">Выход</a></li>
                                    </ul>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="kf-dropdown">
                                <a href="#">
                                    Гость <span uk-icon="chevron-down"></span></a>
                                <div class="uk-navbar-dropdown kf-dropdown-menu">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li><a href="<?= Url::to(['auth/login']) ?>">Вход</a></li>
                                        <li><a href="<?= Url::to(['auth/register']) ?>">Регистрация</a></li>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>

                </div>
            </nav>
        </header>
        <?= $content ?>
    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
