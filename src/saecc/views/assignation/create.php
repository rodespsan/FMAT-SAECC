<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Assignation */

$this->title = Yii::t('app', 'Create Assignation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignation-create">

    <h1 align="center"><?= Html::encode($this->title) ?></h1>
	<hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
