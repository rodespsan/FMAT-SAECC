<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EquipmentType */

/* $this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Equipment Type',
]) . ' ' . $model->name; */
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Equipment Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="equipment-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
