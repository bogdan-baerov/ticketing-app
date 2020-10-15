<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Users;
use backend\controllers\UsersController;
use yii\helpers\ArrayHelper;
use yii\jui\Autocomplete;
use yii\web\JsExpression;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model frontend\models\Tickets */
/* @var $users frontend\models\Users */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tickets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $data = Users::find()
    ->select(['name as value', 'name as label','id as id'])
    ->asArray()
    ->all();
    echo '<div class="form-group field-tickets-id_user required">';
    echo '<label class="control-label"><i class="fas fa-user"></i> Introduceți numele complet</label><br>';
    echo AutoComplete::widget([
    'name' => 'Tickets[id_user]',    
    'id' => 'ddd',
    'options' => ['class' => 'form-control', 'maxlength' => 10, 'placeholder' => 'Introduceți numele dumneavoastră complet', 'aria-required' => true, 'aria-invalid' => true],
    'clientOptions' => [
        'source' => $data, 
        'autoFill'=>true,
         'select' => new JsExpression("function( event, ui ) {
        $('#tickets-id_user').val(ui.item.id);//#tickets-id_user is the id of hiddenInput.
     }")],
     ]);
     echo "</div>";
     ?>

    <?= $form->field($model, 'id_user')->hiddenInput()->label(false)?>

    <?php $model->priority = 'Normal'; ?>
    <?= 
        
        $form->field($model, 'priority')->radioList([
            'Normal' => 'Normal', 
            'Urgent' => 'Urgent',
            'Prioritar' => 'Prioritar'
        ])->label('<i class="fas fa-exclamation"></i> Selectați nivelul de prioritate');
    ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true, 'placeholder' => 'Introduceți locația dumneavoastră(Corp-Etaj-Cameră); Exemplu: C-1-25'])->label('<i class="fas fa-map-marker-alt"></i></i> Introduceți locația') ?>

    <?= $form->field($model, 'problem')->textArea(['maxlength' => true, 'placeholder' => 'Introduceți detaliile problemei dumneavoastră în acest câmp'])->label('
    <i class="fas fa-keyboard"></i> Descrieți sumar problema') ?>

    <div class="form-group">
        <?= Html::submitButton('Trimite ticket <i class="fas fa-check"></i>', ['class' => 'btn btn-block btn-lg btn-success btn-submit-ticket']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

        
