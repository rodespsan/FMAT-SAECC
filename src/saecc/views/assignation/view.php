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

    <div>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-right',
            'data' => [
                'confirm' => Yii::t('app', '¿Borrar esta Asignación?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a('Regresar', ['index'], ['class' => 'btn btn-success btn-right']) ?>
    </div>
<br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'date',
            //'client_id',
			'client.client_id:text:ID del Cliente',
            //'room_id',
			'client.full_name',
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
