<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\EquipmentStatus;//Exporta a equipmentStatus
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

    <?= $form->field($model, 'equipment_status_id')->dropDownList(
	ArrayHelper::map(EquipmentStatus::find()->all(),
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

    <?= $form->field($model, 'location_id')->textInput(['maxlength' => true]) ?>

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
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
