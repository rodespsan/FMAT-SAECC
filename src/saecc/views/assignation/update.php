<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Assignation */

/* $this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Assignation',
]) . ' ' . $model->id; */
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="assignation-update">

    <h1><?= Html::encode($this->title) ?></h1>
<br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
