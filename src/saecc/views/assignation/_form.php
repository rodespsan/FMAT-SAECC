<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Room;
use app\models\Location;
use app\models\Equipment;

/* @var $this yii\web\View */
/* @var $model app\models\Assignation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignation-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?php date_default_timezone_set("America/Mexico_City"); 
		//echo "DATE: " . date("Y/m/d") . "<br><br>";
	?>

    <!--?= $form->field($model, 'date')->textInput() ?-->

    <?= $form->field($model, 'client_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'room_id')->dropDownList(
		ArrayHelper::map(
			Room::find()->all(),
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

    <!--?= $form->field($model, 'start_time')->textInput() ?-->

    <!--?= $form->field($model, 'end_time')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
