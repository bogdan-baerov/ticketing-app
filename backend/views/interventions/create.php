<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Interventions */

$this->title = 'Înregistrare intervenție';
?>
<div class="interventions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
