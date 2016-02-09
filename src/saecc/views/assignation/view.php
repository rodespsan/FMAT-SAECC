<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Assignation */

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignation-view">

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
            'date',
            //'client_id',
			'client.client_id:text:Clave',
            //'room_id',
			'room.name:text:Salón',
            //'location_id',
			'location.location:text:Ubicación',
            //'equipment_id',
			'equipment.inventory:text:No. de Inventario',            
            'purpose',
            'duration',
            'start_time',
            'end_time',
        ],
    ]) ?>

</div>
