<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizatori';
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= Html::a('Creare utilizator', ['create'], ['class' => 'btn btn-lg btn-success']) ?>  <?= Html::a('Creare utilizator IT', ['site/signup'], ['class' => 'btn btn-lg btn-primary']) ?>

    <div style="margin-top:30px;"></div>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'account',
            'department',
            'location',
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fas fa-eye fa-2x" style="padding-right:0.5em;"></i>', $url, [
                            'title' => Yii::t('app', 'Vizualizare detalii utilizator'),
                        ]);  
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fas fa-edit fa-2x" style="padding-right:0.5em;"></i>', $url, [
                            'title' => Yii::t('app', 'Modificare date utilizator'),
                        ]);  
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash fa-2x"></i>', $url, [
                            'title' => Yii::t('app', 'Ștergere utilizator'),
                        ]);  
                    }
                    ],
            ],
        ],
    ]); ?>


</div>
