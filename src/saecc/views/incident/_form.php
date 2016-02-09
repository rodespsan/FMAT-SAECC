<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incident */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incident-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'equipment_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'room_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
	<?= $form->field($model, 'solved')->checkbox([],false); ?>

    <?= $form->field($model, 'date_solved')->textInput() ?>

    <?= $form->field($model, 'client_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
