<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $ticketModel backend\models\Tickets*/
/* @var userList array of Appusers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeDropDownList($ticketModel, 'id_it_user' ,$userList) ?>

    <div style="margin-bottom:30px"></div>

    <div class="form-group">
        <?= Html::submitButton('Transfer tichet', ['class' => 'btn btn-lg btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
    