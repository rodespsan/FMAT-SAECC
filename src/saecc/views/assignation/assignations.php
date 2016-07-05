<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use app\models\Room;
use app\models\Location;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssignationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* $this->title = Yii::t('app', 'Assignations');
$this->params['breadcrumbs'][] = $this->title; */
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignations'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Todas las asignaciones');
?>

<h1 align="center"><?=	'Todas las Asignaciones',
	Html::a('Regresar', ['index'], ['class' => 'btn btn-success btn-md', 'style' => 'float:right; margin-left:4px;']),	
	Html::a('', ['assignations'], ['class' => 'btn btn-primary btn-md glyphicon glyphicon-refresh', 'style' => 'float:right;'])
?></h1>	

<div class="assignation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php
	$locationQuery = Location::find()->joinWith(['room'])->where(['location.active' => 1, 'room.available' => 1]);
	if(!empty(Yii::$app->request->queryParams['AssignationSearch']) && !empty(Yii::$app->request->queryParams['AssignationSearch']['room']))
	{
		$locationQuery->andWhere(['room.id' => Yii::$app->request->queryParams['AssignationSearch']['room']]);
	}
	?>
	
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
				'filter' => ArrayHelper::map(
					Room::find()->where(['available' => 1])->all(),
					'id',
					'name'
				),
			],
            //'location_id',
			[
				'attribute' => 'location',
				'value' => 'location.location',
				'label' => Yii::t('app', 'Location ID'),
				'filter' => ArrayHelper::map(
					//Location::find()->all(),
					//Location::find()->joinWith(['assignations'])->where(['like', 'assignation.date', date('Y-m-d')])->all(),
					//Location::find()->joinWith(['room'])->where(['location.active' => 1, 'room.available' => 1])->all(),
					$locationQuery->all(),
					'id',
					'fullLocation'
				),
				'filterInputOptions' => [
					'id' => 'search-assignation-location-id',
					'class' => 'form-control'
				],
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

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>