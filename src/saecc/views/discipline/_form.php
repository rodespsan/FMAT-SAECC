<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Area;
use app\models\School;

/* @var $this yii\web\View */
/* @var $model app\models\Discipline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discipline-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 175]) ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'area_id')->dropDownList(
		ArrayHelper::map(
			Area::find()->orderBy('name ASC')->all(),
			'id',
			'name')
		)
	?>
	
	<?= $form->field($model, 'school_id')->dropDownList(
		ArrayHelper::map(
			School::find()->orderBy('name ASC')->all(),
			'id',
			'name')
		)
	?>
	
	<?= $form->field($model, 'active')->checkbox([],false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-danger btn-md', 'style' => 'float:right;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
