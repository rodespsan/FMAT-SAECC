<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Discipline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discipline-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'school_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 175]) ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'area_id')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
