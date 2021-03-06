<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LogType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => 45]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-danger btn-md', 'style' => 'float:right;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
