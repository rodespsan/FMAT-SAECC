<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 175]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 20]) ?>

	<?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => 20]) ?>
	
	<?= $form->field($model, 'rol')->dropDownList([
		'Básico'=>'Básico',
		'Operador'=>'Operador',
		'Administrador'=>'Administrador',
	]) ?>
	
	<?= $form->field($model, 'active')->checkbox([],false); ?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-danger btn-md', 'style' => 'float:right;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
