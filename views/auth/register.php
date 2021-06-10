<?php

use app\widgets\UkAlert;

?>
<div class="uk-container uk-container-xsmall ">
    <div class="uk-flex-center uk-flex-middle uk-grid-collapse" uk-grid>
        <?=UkAlert::widget($alert)?>
        <form method="post" class="uk-position-center">
            <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
            <h2 class="auth_title">Регистрация</h2>
            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                    <input class="uk-input" type="text" name="login" placeholder="Ваш логин">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon " uk-icon="icon: lock"></span>
                    <input class="uk-input" type="password" name="password" placeholder="Ваш пароль">
                </div>
            </div>

            <!--     Доп. поля, капча, повторите параоль и т.д       -->

            <div class="uk-margin">
                <button class="uk-button chat-button uk-width" type="submit">Зарегистрироваться</button>
            </div>
        </form>
    </div>
</div>