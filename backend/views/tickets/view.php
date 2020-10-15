<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tickets */

$this->title = 'Tichetul #'.$model->id;
\yii\web\YiiAsset::register($this);
?>

<div class="tickets-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <div style="margin-top:30px;"></div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'id_user',
                'label' => 'Utilizator',
                'value' => function($model){
                    return $model->user->account;
                }
            ],
            'ip_address',
            'priority',
            'location',
            'problem',
            'date',
            'status',
            [
                'attribute' => 'id_it_user',
                'label' => 'Utilizator IT',
                'value' => function(){
                    return Yii::$app->user->identity->username;
                }
            ],
        ],
    ]) ?>

</div>
