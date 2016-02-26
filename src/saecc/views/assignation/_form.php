<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Client;
use app\models\Room;
use app\models\Location;
use app\models\Equipment;
use yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Assignation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignation-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?=	$form->field($model, 'client_id')->widget(\yii\jui\AutoComplete::classname(), [
		'clientOptions' => [
			//'source' => ['usr', 'asr', 'pois'],
			/* 'source' => ArrayHelper::map(
			Location::find()->all(),
			'id',
			'name'), */
			'source' => ArrayHelper::getColumn(Client::find()->all(),
			'client_id'),//[ArrayHelper::getColumn($model, 'id')],
		],
	]) ?>
    
    <?= $form->field($model, 'room_id')->dropDownList(
		ArrayHelper::map(
			Room::find()->where(['available' => 1])->all(),
			'id',
			'name')			
		)
	?>
	
	<?= $form->field($model, 'location_id')->dropDownList(
		ArrayHelper::map(
			Location::find()->all(),
			'id',
			'location')
		)
	?>
	
    <?= $form->field($model, 'equipment_id')->dropDownList(
		ArrayHelper::map(
			Equipment::find()->all(),
			'id',
			'inventory')			
		)
	?>

    <?= $form->field($model, 'purpose')->textarea(['maxlength' => 170]) ?>

    <?= $form->field($model, 'duration')->dropDownList(
		[15 => '15 min.', 30 => '30 min.', 45 => '45 min.', 60 => '1:00', 90 => '1:30 ', 120 => '2:00'],
		[
			'prompt' => Yii::t('app','Select a period of time'),
		]
		)
	
	?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
