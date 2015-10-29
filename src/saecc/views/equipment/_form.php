<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inventory')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 175]) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => 175]) ?>

    <?= $form->field($model, 'status_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'room_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'available')->textInput() ?>

    <?= $form->field($model, 'type_id')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
