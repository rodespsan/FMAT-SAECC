<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ClientType;
use app\models\Discipline;
use yii\bootstrap\ActiveForm;

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
			case "1": $("[name=\'Client[discipline_id]\']").removeAttr("disabled");
			$(".field-client-discipline_id").show();
			break; 
			case "2": 
			case "3":
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

    <!--?php $form = ActiveForm::begin(); ?-->
	<?php $form = ActiveForm::begin([
		'layout' => 'horizontal',
		'options' => ['enctype' => 'multipart/form-data'],
	]);
	//$model->room_id = Room::find()->where(['name'=>Yii::$app->params['defaultRoom']])->one()->id;
	?>

    <?= $form->field($model, 'client_id')->textInput(['maxlength' => 30, 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();'])?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => 175, 'onkeyup' => 'javascript:this.value=this.value.toUpperCase();'])?>

    <?= $form->field($model, 'client_type_id')->radioList(
		ArrayHelper::map(
			ClientType::find()->all(),
			'id',
			'type'))
	?>

    <?= $form->field($model, 'discipline_id')->dropDownList(
		ArrayHelper::map(
			Discipline::find()->orderBy('name ASC')->all(),
			'id',
			'name'))
	?>

    <?= $form->field($model, 'active')->checkbox([],false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'float:left; margin-left:299px;']) ?>
		<?= Html::a('Cancelar', ['assignation/create'], ['class' => 'btn btn-danger btn-md', 'style' => 'margin-left:396px;']) ?>
		<!--?= Html::a('Cancelar', [Yii::$app->request->referrer], ['class' => 'btn btn-danger btn-md', 'style' => 'margin-left:396px;']) ?-->
    </div>

    <?php ActiveForm::end(); ?>

</div>
