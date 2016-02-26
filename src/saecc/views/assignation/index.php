<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssignationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Assignations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Assignation'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'date',
            //'client_id',
			[
				'attribute' => 'client',
				'value' => 'client.client_id',
				'label' => Yii::t('app', 'Client ID'),
			],
            //'room_id',
			[
				'attribute' => 'room',
				'value' => 'room.name',
				'label' => Yii::t('app', 'Room ID'),
			],
            //'location_id',
			[
				'attribute' => 'location',
				'value' => 'location.location',
				'label' => Yii::t('app', 'Location ID'),
			],
            //'equipment_id',
			[
				'attribute' => 'equipment',
				'value' => 'equipment.inventory',
				'label' => Yii::t('app', 'Inventory'),
			],
            'purpose',
            'duration',
            'start_time',
            'end_time',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => ' {update} {terminate} {report}',
				'buttons' => [
					//Actualiza la hora final y la duración de una asignación en base a la hora en que se de por terminada una asignación
					'terminate' => function ($url, $model, $key) {						
					return Html::a('<span class="glyphicon glyphicon-pause"></span>', $url, 
						[
							'title' => Yii::t('app', 'Terminate assignation'),
						]);
					},
					
					'update' => function ($url, $model) {
							return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
							[
									'title' => Yii::t('app', 'Update'),
							]);
					},
				],
				'urlCreator' => function ($action, $model) {																				
					if ($action === 'update') {						
						return Url::to(['assignation/update?id=' . $model->id]);
					}
					
					//Actualiza la hora final y la duración de una asignación en base a la hora en que se de por terminada una asignación
					if ($action === 'terminate') {
						return Url::to(['assignation/terminate?id=' . $model->id]);
					}
					
				}
			],
        ],
    ]); ?>

</div>
