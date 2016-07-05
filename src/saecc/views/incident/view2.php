<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Incident */

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incidents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="incident-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!--?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?-->
        <!--?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?-->
		<?= Html::a('Regresar', ['assignation/index'], ['class' => 'btn btn-success btn-right']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'date',
            //'equipment_id',
			//'equipment.inventory',
            //'room_id',
			'room.name:text:Salón',
			'equipment.location.location',
			'equipment.inventory',
            'description:ntext',
            //'solved',
			[
				'attribute' => 'solved',
				'value' => ($model->solved) ? 'Si' : 'No',
			],	
            'date_solved',
            //'client_id',
			//'client.client_id:text:Cliente',
			'client.client_id',
            //'user_id',
			'user.user_name:text:Usuario',
        ],
    ]) ?>

</div>
