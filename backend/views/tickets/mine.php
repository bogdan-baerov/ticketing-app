<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\Users;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TicketsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tichetele mele';
?>
<div class="my-tickets">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'id_user',
                'label' => 'Utilizator',
                'value' => 'user.account',
                'filter'=> ArrayHelper::map(Users::find()->all(), 'id', 'account')
            ],
            'ip_address',
            [
                'attribute' => 'priority',
                'filter'=> ['Normal' => 'Normal', 'Urgent' => 'Urgent', 'Prioritar' => 'Prioritar']
            ],  
            'location',
            'problem',
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{intervention}{interventionsTicket}',
                'buttons' => [
                    'intervention' => function ($url, $model) {
                        return Html::a('<i class="fas fa-wrench fa-2x" style="padding-right:0.5em;"></i>', $url, [
                        'title' => Yii::t('app', 'Intervenție'),
                        ]);
                    },
                    'interventionsTicket' => function ($url, $model) {
                        return Html::a('<i class="fas fa-toolbox fa-2x"></i>', $url, [
                        'title' => Yii::t('app', 'Intervențiile tichetului'),
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'intervention') {
                        $url = Url::to(['interventions/create', 'id_ticket' => $model->id, 'id_user' => Yii::$app->user->id]);
                        return $url;
                    }else if ($action === 'interventionsTicket') {
                        $url = Url::to(['interventions/index', 'id_ticket' => $model->id, 'id_user' => Yii::$app->user->id]);
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>


</div>


