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

    <!-- $form->field($model, 'password_hash')->textInput(['maxlength' => 175]) -->
	
	<?= $form->field($model, 'password')->passwordInput(['maxlength' => 20]) ?>
	
	<?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => 20]) ?>

    <!--?= $form->field($model, 'auth_key')->textInput(['maxlength' => 128]) ?-->

    <!--?= $form->field($model, 'access_token')->textInput(['maxlength' => 128]) ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
