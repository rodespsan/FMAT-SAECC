<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Equipments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Equipment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'inventory',
            //'equipment_type_id',
			[
				'attribute' => 'equipmentType',
				'value' => 'equipmentType.name',
				'label' => Yii::t('app', 'Equipment Type ID'),
			],
            'description',
            'serial_number',
            //'equipment_status_id',
			[
				'attribute' => 'equipmentStatus',
				'value' => 'equipmentStatus.status',
				'label' => Yii::t('app', 'Equipment Status ID'),
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
            //'available',			
			[
				'attribute' => 'available',
				'value' => function ($model, $key, $index, $column) {
					return ($model->available) ? 'Si' : 'No';
				} ,
				'filter' => ArrayHelper::map([
					['id'=>1, 'text'=>'Si'],
					['id'=>0, 'text'=>'No'],
				], 'id', 'text'),
			],

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update}',				
			],
        ],
    ]); ?>

</div>
