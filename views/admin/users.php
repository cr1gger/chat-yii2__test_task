<?php

use app\models\Rbac;
use yii\grid\GridView;
use yii\helpers\Html;

?>
<div class="uk-container uk-container-small">
    <div class="uk-flex-center uk-grid-collapse" uk-grid>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'login',
                [
                        'attribute' => 'id',
                        'label' => 'Группа пользователя',
                        'format' => 'raw',
                        'value' => function ($data) {
                                # если ролей было бы больше или можно создавать, я бы сделал подгрузку из базы.
                                # а так просто статика )

                                return Html::dropDownList('user_role_' . $data->id, Rbac::getRoleByUserId($data->id), [
                                        Rbac::ROLE_ADMIN => Rbac::ROLE_ADMIN,
                                        Rbac::ROLE_GUEST => Rbac::ROLE_GUEST,
                                        Rbac::ROLE_USER => Rbac::ROLE_USER,
                                ], ['class' => 'uk-select event_select']);
                        }
                ]
            ],
            'tableOptions' => ['class' => 'uk-table uk-table-hover']
        ]);
        ?>
    </div>
</div>