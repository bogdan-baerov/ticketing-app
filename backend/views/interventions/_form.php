<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Interventions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="interventions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'observation')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'intervention')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <label>Tichet finalizat?</label>
    <?= Html::checkbox('ticketStatus') ?>

    <div class="form-group">
        <?= Html::submitButton('Înregistrare intervenție', ['class' => 'btn btn-lg btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
    