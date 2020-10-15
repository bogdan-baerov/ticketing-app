<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use backend\models\Users;
use backend\models\Appusers;
use backend\models\Interventions;
use backend\models\Tickets;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TicketsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Raport Tichete';

function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

?>
<div class="tickets-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'id_user',
                'label' => 'Utilizator',
                'value' => 'user.account',
                'filter'=> ArrayHelper::map(Users::find()->all(), 'id', 'account')
            ],
            [
                'attribute' => 'date',
                'filter'=> ArrayHelper::map(Tickets::find()->all(), 'date', 'date')
            ],
            'ip_address',
            [
                'attribute' => 'priority',
                'filter'=> ['Normal' => 'Normal', 'Urgent' => 'Urgent', 'Prioritar' => 'Prioritar']
            ],  
            'location',
            'problem',
            [
                'attribute' => 'status',
                'filter'=> ['Creat' => 'Creat', 'În curs' => 'În curs', 'Finalizat' => 'Finalizat'],
                'format' => 'html',
                'value' => function($model){
                    switch($model->status){
                        case 'Creat':
                            return '<span class="label label-danger">'.$model->status.'</span>';
                        break;
                        case 'În curs':
                            return '<span class="label label-warning">'.$model->status.'</span>';
                        break;
                        case 'Finalizat':
                            return '<span class="label label-success">'.$model->status.'</span>';
                        break;
                    }
                }
            ],
            [
                'attribute' => 'id_it_user',
                'label' => 'Utilizator IT',
                'value' => 'itUser.username',
                'filter'=> ArrayHelper::map(Appusers::find()->asArray()->all(), 'id', 'username')
            ],
            [
                'attribute' => 'durationTotal',
                'label' => 'Durată totală',
                'value' => function($model){
                    $durationTotal = 0;
                    foreach(Interventions::find()->where(['id_ticket' => $model->id])->all() as $intervention){
                        $durationTotal += $intervention->duration;
                    }
                        if($durationTotal > 60){
                            $hourFormat = $durationTotal / 60;
                            return convertToHoursMins($durationTotal, '%02d ore si %02d minute');
                        }else if($durationTotal >= 20 && $durationTotal < 60){
                            return $durationTotal. ' de minute';
                        }else if($durationTotal < 20){
                            return $durationTotal.'  minute';
                        }else if($durationTotal == 60){
                            return "o oră";
                        }
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}{interventionsTicket}{transfer}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fas fa-eye fa-2x" style="padding-right:0.5em;"></i>', $url, [
                        'title' => Yii::t('app', 'Detalii tichet'),
                        ]);
                    },
                    'interventionsTicket' => function ($url, $model) {
                        return Html::a('<i class="fas fa-toolbox fa-2x" style="padding-right:0.5em;"></i>', $url, [
                        'title' => Yii::t('app', 'Intervențiile tichetului'),
                        ]);
                    },
                    'transfer' => function ($url, $model) {
                        return Html::a('<i class="fas fa-exchange-alt fa-2x"></i>', $url, [
                        'title' => Yii::t('app', 'Transfer tichet'),
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url = Url::to(['tickets/view', 'id' => $model->id]);
                        return $url;
                    }else if ($action === 'interventionsTicket') {
                        $url = Url::to(['interventions/index', 'id_ticket' => $model->id, 'id_user' => Yii::$app->user->id]);
                        return $url;
                    }else if ($action === 'transfer') {
                        $url = Url::to(['tickets/transfer', 'id' => $model->id]);
                        return $url;
                    }
                }
            ]
        ];
    ?>
    <?php
        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns
        ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns
    ]); ?>


</div>


