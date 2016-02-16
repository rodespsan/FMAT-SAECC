<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IncidentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Incidents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incident-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Incident'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'date',
            //'equipment_id',
			[
				'attribute' => 'equipment',
				'value' => 'equipment.inventory',
				'label' => Yii::t('app', 'Inventory'),
			],
            //'room_id',
			[
				'attribute' => 'room',
				'value' => 'room.name',
				'label' => Yii::t('app', 'Room'),
			],
            'description:ntext',
            //'solved',
			[
				'attribute' => 'solved',
				'value' => function ($model, $key, $index, $column) {
					return ($model->solved) ? 'Si' : 'No';
				} ,
				'filter' => ArrayHelper::map([
					['id'=>1, 'text'=>'Si'],
					['id'=>0, 'text'=>'No'],
				], 'id', 'text'),
			],
            'date_solved',
            //'client_id',
			[
				'attribute' => 'client',
				'value' => 'client.client_id',
				'label' => Yii::t('app', 'Client'),
			],
            //'user_id',
			[
				'attribute' => 'user',
				'value' => 'user.user_name',
				'label' => Yii::t('app', 'User'),
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
