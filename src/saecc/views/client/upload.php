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


<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'csvFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Index') : Yii::t('app', 'Index'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<!--?= Html::submitButton($model->csvFile, ['class' => 'btn btn-success btn-md']) ?-->
		<?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-danger btn-md']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
