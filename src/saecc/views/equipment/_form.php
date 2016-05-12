<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\EquipmentStatus;
use app\models\Room;
use app\models\EquipmentType;
use app\models\Location;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inventory')->textInput(['maxlength' => true]) ?>
    
	<?= $form->field($model, 'equipment_type_id')->dropDownList(
		ArrayHelper::map(
			EquipmentType::find()->all(),
			'id',
			'name')
		)
	?>

    <?= $form->field($model, 'description')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>
    
	<?= $form->field($model, 'equipment_status_id')->dropDownList(
		ArrayHelper::map(
			EquipmentStatus::find()->all(),
			'id',
			'status')
		)
	?>

    <?= $form->field($model, 'room_id')->dropDownList(
			ArrayHelper::map(
				Room::find()->all(),
				'id',
				'name'
			),
			[	
				'prompt' => 'Selecciona un Salón...',
				'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('equipment/list-locations?id=').'"+$(this).val(), function(data){
					$("#equipment-location_id").html(data);
				})',
			]
		)
	?>			
	
    <!--?= $form->field($model, 'location_id')->dropDownList(
		ArrayHelper::map(
			Location::find()->all(),
			'id',
			'location')			
		)
	?-->
	
	<?php
	$locationData = [];
	if(!empty($model->room_id))
	{
		$locationData = ArrayHelper::map(
			Location::find()->where(['room_id' => $model->room_id])->all(),
			'id',
			'location'
		);
	}
	?>
	
	<?= $form->field($model, 'location_id')->dropDownList(
			$locationData,
			[	
				'prompt' => 'Selecciona un Ubicación...',
			]
		)
	?>

    <!--?= $form->field($model, 'available')->Checkbox([],false) ?-->
	<?= $form->field($model, 'available')->checkbox([],false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
