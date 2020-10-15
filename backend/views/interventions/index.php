<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InterventionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$ticketNumber = \Yii::$app->request->get('id_ticket');

$this->title = 'Intervențiile tichetului #'.$ticketNumber;

function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}


?>
<div class="interventions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div style="margin-top:30px;"></div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'observation',
            'intervention',
            'date',
            [
                'attribute' => 'duration',
                'label' => 'Durată',
                'value' => function($model){
                        if($model->duration > 60){
                            $hourFormat = $model->duration / 60;
                            return convertToHoursMins($model->duration, '%02d ore si %02d minute');
                        }else if($model->duration >= 20 && $model->duration < 60){
                            return $model->duration. ' de minute';
                        }else if($model->duration < 20){
                            return $model->duration.'  minute';
                        }else if($model->duration == 60){
                            return "o oră";
                        }
                }
            ],
        ]
    ]); ?>


</div>
