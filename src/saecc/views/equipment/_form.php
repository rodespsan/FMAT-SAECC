<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Status;//Exporta a status
use app\models\Room;//Exporta a Room
use app\models\EquipmentType;//Exporta equipmentType
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inventory')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 175]) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => 175]) ?>

    <?= $form->field($model, 'status_id')->dropDownList(
	ArrayHelper::map(Status::find()->all(),
	'id',
	'status'
	
	
	
	)
	
	
	
	
	) ?>

    <?= $form->field($model, 'room_id')->dropDownList(
	
	ArrayHelper::map(Room::find()->all(),
	'id',
	'name'
	
	
	
	)
	
	) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'available')->Checkbox(
	[
	
	],true
	
	) ?>

    <?= $form->field($model, 'type_id')->dropDownList(
	
	ArrayHelper::map(EquipmentType::find()->all(),
	'id',
	'name'
	
	
	
	)
	
	
	) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
