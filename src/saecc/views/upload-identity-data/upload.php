<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ClientType;
use app\models\Discipline;
use app\models\UploadIdentityData;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Alta Masiva');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="client-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	<br></br>
    <?= $form->field($model, 'csvFile')->fileInput() ?>
	<br></br>
    <div class="form-group">
        <!--?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Index') : Yii::t('app', 'Index'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?-->
		<?= Html::submitButton('Darlos de Alta',  ['class' => 'btn btn-success btn-md'], $model->csvFile) ?>
		<?= Html::a('Cancelar', ['client/index'], ['class' => 'btn btn-danger btn-md']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php if (Yii::$app->session->hasFlash('error')): ?>
	<div class="alert alert-danger">
		<?= Yii::$app->session->getFlash('error') ?>
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	</div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error-upload')): ?>
	<?php foreach(Yii::$app->session->getFlash("error-upload") as $message): ?>
	<div class="alert alert-danger">
		<?= $message ?>
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	</div>
	<?php endforeach; ?>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
	<div class="alert alert-success">
		<?= Yii::$app->session->getFlash('success') ?>
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	</div>
<?php endif; ?>