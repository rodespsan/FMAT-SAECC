<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */

/* $this->title = $model->id; */
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Equipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'inventory',
            //'equipment_type_id',
			'equipmentType.name:text:Tipo de Equipo',
            'description',
            'serial_number',
            //'equipment_status_id',
			'equipmentStatus.status',
            //'room_id',
			'room.name:text:Salón',
            //'location_id',
			'location.location',
            //'available',
			/* [
				'attribute' => 'available',
				'value' => ($model->available) ? 'Si' : 'No',
			], */
			[
				'attribute' => 'available',
				'value' => ($model->available) ? 'Si' : 'No',
			],
        ],
    ]) ?>

</div>
