<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Appusers */

$this->title = 'Create Appusers';
$this->params['breadcrumbs'][] = ['label' => 'Appusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appusers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
