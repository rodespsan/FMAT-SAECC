<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Room;
use app\models\User;
use app\models\Client;
use app\models\Location;
use app\models\EquipmentType;
use app\models\Equipment;
use app\models\Incident;
use kartik\widgets\DateTimePicker;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incident */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incident-form">

    <!--?php $form = ActiveForm::begin(); ?-->
	<?php $form = ActiveForm::begin([
		'layout' => 'horizontal',
		'options' => ['enctype' => 'multipart/form-data'],
	]);
	//$model->room_id = Room::find()->where(['name'=>Yii::$app->params['defaultRoom']])->one()->id;
	?>

	<!--?= $form->field($model, 'date')->textInput() ?-->
	<?= $form->field($model, 'date')->widget(DateTimePicker::classname(), [
			'type'=>DateTimePicker::TYPE_INPUT,
			//'convertFormat' => true,
			'pluginOptions' => [
				'minuteStep' => 1,
				'autoclose' => true,
				'format' => 'yyyy-mm-dd H:ii:s',
				'todayBtn' => true,				
			]
		]);
	?>
	
    <!--?= $form->field($model, 'room_id')->textInput(['maxlength' => 10]) ?-->
	
	<?= $form->field($model, 'room_id')->dropDownList(
			ArrayHelper::map(
				Room::find()->orderBy('name ASC')->all(),
				'id',
				'name'
			),
			[
				'prompt' => 'Selecciona un Salón',
				'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('incident/list-locations?id=').'"+$(this).val(), function(data){
					$("#incident-location_id").html(data);
				})',
			]
		)
	?>

	<!--?= $form->field($model, 'location_id')->dropDownList(
			ArrayHelper::map(
				Location::find()->all(),
				'id',
				'location'
			),
			[
				'prompt' => 'Selecciona una Ubicación',
				'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('incident/list-equipment-types?id=').'"+$(this).val(), function(data){
					$("#incident-equipment_type_id").html(data);
				})',
			]
		)
	?-->
	
	<?php
	$locationData = [];
	if(!empty($model->room_id))
	{
		$locationData = ArrayHelper::map(
			Location::find()->orderBy('location ASC')->where(['room_id' => $model->room_id])->all(),
			'id',
			'location'
		);
	}
	?>
	
	<?= $form->field($model, 'location_id')->dropDownList(
			$locationData,
			[
				'prompt' => 'Selecciona una Ubicación',
				'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('incident/list-equipment-types?id=').'"+$(this).val(), function(data){
					$("#incident-equipment_type_id").html(data);
				})',
			]
		)
	?>
	
	<?php
	$equipmentTypeData = [];
	if(!empty($model->location_id))
	{
		$equipmentTypeData = ArrayHelper::map(
			Equipment::find()->where(['location_id' => $model->location_id])->all(),
			'id',
			'nameWithInventory'
		);
	}
	?>
	
	<?= $form->field($model, 'equipment_type_id')->dropDownList(
		$equipmentTypeData,
		[
			//'prompt' => 'Selecciona un Tipo de Equipo',
			'onchange' => '$("#incident-equipment_id").val($(this).val()).trigger("change");',
		]
	) ?>
	
	<!--?= $form->field($model, 'equipment_type_id')->dropDownList(
		$equipmentTypeData,
		[
			//'prompt' => 'Selecciona un Tipo de Equipo',
			'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('incident/show-inventory?id=').'"+$(this).val(), function(data){
				// $("#incident-equipment_id").html(data);
				// alert(data);
				$("#incident-equipment_id").val(data).trigger("change");
			})',
		]
	) ?-->
	
	<!--?= $form->field($model, 'equipment_id')->textInput([
		'maxlength'=>true,
		'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('incident/get-equipment-information?inventory=').'"+$(this).val(), function(data){
			// $("#incident-equipment_id").html(data);
			$("#incident-equipment_id").val(data);
		})',
	]) ?-->
	
	<?= $form->field($model, 'equipment_id')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(
			Equipment::find()->all(),
				'id',
				'inventory'
		),
		'options' => [
			'placeholder' => 'Ingresa el número de inventario...',
			'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('incident/get-equipment-information?id=').'"+$(this).val(), function(data){
				// $("#incident-equipment_id").html(data);
				// $("#incident-description").html(data);
				var equipment = JSON.parse(data);
				$("#incident-room_id").val(equipment.room_id);
				$.post("'.Yii::$app->urlManager->createUrl('incident/list-locations?id=').'"+$("#incident-room_id").val(), function(data){
					$("#incident-location_id").html(data);
					$("#incident-location_id").val(equipment.location_id);
					$.post("'.Yii::$app->urlManager->createUrl('incident/list-equipment-types?id=').'"+$("#incident-location_id").val(), function(data){
						$("#incident-equipment_type_id").html(data);
						$("#incident-equipment_type_id").val(equipment.equipment_id);
					})
				})
			})',
		],
		'pluginOptions' => [
			//'width' => '349px',
			'allowClear' => true
		]
	]); ?>
	
	<!--?= $form->field($model, 'equipment_id')->dropDownList(
			//['readonly' => true]
			ArrayHelper::map(
				Equipment::find()->where(['id' => $model->equipment_id])->all(),
				'id',
				'inventory'
			)
		)
	?-->
	
	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
	<!--?= $form->field($model, 'client_id')->widget(\yii\jui\AutoComplete::classname(), [
		'clientOptions' => [
			'source' => Yii::$app->urlManager->createUrl('incident/list-clients'),
		],
	]) ?-->
	
	<!--?= $form->field($model, 'client_id')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(
			Client::find()->all(),
				'id',
				'client_id', 'full_name'
		),
		'options' => ['placeholder' => 'Selecciona una opción...'],
		'pluginOptions' => [
			'allowClear' => true
		],
	]); ?-->
	
	<?= $form->field($model, 'client_id')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(
			Client::find()->all(),
				'id',
				'searchableName'
		),
		'options' => ['placeholder' => 'Selecciona un Cliente...'],
		'pluginOptions' => [
			//'width' => '349px',
			'allowClear' => true
		]
	]); ?>
	
    <?= $form->field($model, 'user_id')->dropDownList(
		ArrayHelper::map(
			User::find()->all(),
			'id',
			'user_name')			
		)
	?>
	
	<?= $form->field($model, 'solved')->checkbox([],false); ?>

    <!--?= $form->field($model, 'date_solved')->textInput() ?-->
	
	<?= $form->field($model, 'date_solved')->widget(DateTimePicker::classname(), [
			'type'=>DateTimePicker::TYPE_INPUT,
			//'convertFormat' => true,
			'pluginOptions' => [
				'minuteStep' => 1,
				'autoclose' => true,
				'format' => 'yyyy-mm-dd H:ii:s',
				'todayBtn' => true,				
			]
		]);
	?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'float:left; margin-left:299px;']) ?>
		<?= Html::a('Cancelar', ['assignation/index'], ['class' => 'btn btn-danger btn-md', 'style' => 'margin-left:396px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
