<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Room;
use app\models\User;
use app\models\Client;
use kartik\widgets\DateTimePicker;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Incident */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incident-form">

    <?php $form = ActiveForm::begin(); ?>

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
			Room::find()->all(),
			'id',
			'name'
		),
		[
			'prompt' => 'Seleecciona un Salón',
			'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('incident/list-locations?id=').'"+$(this).val(), function(data){
				$("#incident-location_id").html(data);
			})',
		]
	) ?>

	<?= $form->field($model, 'location_id')->dropDownList(
		[],
		[
			//'prompt' => 'Selecciona una Ubicación',
			'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('incident/list-equipment-types?id=').'"+$(this).val(), function(data){
				$("#incident-equipment_type_id").html(data);
			})',
		]
		)
	?>
		
	<?= $form->field($model, 'equipment_type_id')->dropDownList(
		[],
		[
			//'prompt' => 'Selecciona un Tipo de Equipo',
			'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('incident/show-inventory?id=').'"+$(this).val(), function(data){
				$("#incident-equipment_id").html(data);
				//$("#incident-equipment_id").val(data);
			})',
		]
		)
	?>
	
	<?= $form->field($model, 'equipment_id')->dropDownList([]
		//['readonly' => true]
	) ?>
	
	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
	<!--?= $form->field($model, 'client_id')->widget(\yii\jui\AutoComplete::classname(), [
		'clientOptions' => [
			'source' => Yii::$app->urlManager->createUrl('incident/list-clients'),
		],
	]) ?-->	
	<?= $form->field($model, 'client_id')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(
			Client::find()->all(),
				'id',
				'client_id', 'first_name'
		),
		'options' => ['placeholder' => 'Selecciona una opción...'],
		'pluginOptions' => [
			'allowClear' => true
		],
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
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
