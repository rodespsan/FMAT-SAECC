<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Assignation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'equipment_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'room_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'purpose')->textInput(['maxlength' => 170]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
