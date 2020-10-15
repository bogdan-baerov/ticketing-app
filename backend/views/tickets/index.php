<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\Users;
use backend\models\Appusers;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TicketsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preluare tichete';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tickets-index">

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
                'template' => '{take}',
                'buttons' => [
                'take' => function ($url, $model) {
                    return Html::a('<i class="fas fa-user-check fa-2x"></i>', $url, [
                        'title' => Yii::t('app', 'Preluare'),
                    ]);  
                }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'take') {
                        $url = Url::to(['tickets/take', 'id' => $model->id, 'id_it_user' => Yii::$app->user->id, 'status' => "În curs"]);
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>


</div>


