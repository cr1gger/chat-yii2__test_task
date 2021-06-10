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
                [
                        'label' => 'Автор',
                        'attribute' => 'owner_id',
                        'value' => function($data) {
                            return $data->owner->login;
                        }
                ],
                'message',
                [
                        'label' => 'Действие',
                        'format' => 'raw',
                        'value' => function($data) {
                            return Html::a('Вернуть сообщение', ['admin/return-message', 'message_id' => $data->id], [
                                    'class' => 'uk-button chat-button uk-button-small',
                                    'data' => [
                                        'confirm' => 'Вернуть сообщение с ID: ' .$data->id . ' ?',
                                    ],
                            ]);
                        }
                ]

            ],
            'tableOptions' => ['class' => 'uk-table uk-table-hover']
        ]);
        ?>
    </div>
</div>