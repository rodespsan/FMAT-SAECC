<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ClientType;
use app\models\Discipline;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 175]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 175]) ?>

    <?= $form->field($model, 'client_type_id')->radioList(
		ArrayHelper::map(
			ClientType::find()->all(),
			'id',
			'type'))
	?>

    <?= $form->field($model, 'discipline_id')->dropDownList(
		ArrayHelper::map(
			Discipline::find()->all(),
			'id',
			'name'),
			[
				'prompt' => Yii::t('app','Select a discipline (for students only)'),
			]
		)
	?>

    <?= $form->field($model, 'active')->checkbox([],false); ?>
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
