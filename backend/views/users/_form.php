<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Users;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Numele complet'])->label('Numele complet') ?>

    <?= $form->field($model, 'account')->textInput(['maxlength' => true, 'placeholder' => 'Numele utilizatorului'])->label('Numele utilizatorului') ?>

    <?= $form->field($model, 'department')->textInput(['maxlength' => true, 'placeholder' => 'Denumirea departamentului'])->label('Departament') ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true, 'placeholder' => 'Locația'])->label('Locația') ?>

    <div class="form-group">
        <?php if(Yii::$app->controller->action->actionMethod === "actionCreate"){ ?>
            <?= Html::submitButton('Creare utilizator', ['class' => 'btn btn-lg btn-success']) ?>
        <?php }else{ ?>
            <?= Html::submitButton('Salvare modificări', ['class' => 'btn btn-lg btn-primary']) ?>
        <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
