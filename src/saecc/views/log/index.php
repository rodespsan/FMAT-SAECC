<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Log'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
			[
				'attribute' => 'user',
				'value' => 'user.name',
				'label' => Yii::t('app', 'User ID'),
			],
            'date',
            //'log_type_id',
			[
				'attribute' => 'logType',
				'value' => 'log_type.type',
				'label' => Yii::t('app', 'Log Type ID'),
			],
            'equipment_type',	
            'inventory',
            //'equipment_id',
			[
				'attribute' => 'equipment',
				'value' => 'equipment.serial_number',
				'label' => Yii::t('app', 'Serial Number'),
			],
            'room_id',
            'location',
            //'equipment_status_id',
			[
				'attribute' => 'equipmentStatus',
				'value' => 'equipment_status.status',
				'label' => Yii::t('app', 'Equipment Status'),
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
