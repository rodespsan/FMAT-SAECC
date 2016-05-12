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

<?php $this->registerJs('
	
	function toggleDiscipline()
	{
		var clientType = $("[name=\'Client[client_type_id]\']:checked").val();
		switch( clientType )
		{
			case "1": 
			case "2": 
			case "3": $("[name=\'Client[discipline_id]\']").removeAttr("disabled");
			$(".field-client-discipline_id").show();
			break;
			case "4": $("[name=\'Client[discipline_id]\']").attr("disabled","disabled");
			$(".field-client-discipline_id").hide();
			break;
		}
	}
	
	$("[name=\'Client[client_type_id]\']").change(function(){
		toggleDiscipline();	
	});
	
	toggleDiscipline();	
'); ?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => 175]) ?>

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
			'name'))
	?>

    <?= $form->field($model, 'active')->checkbox([],false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
