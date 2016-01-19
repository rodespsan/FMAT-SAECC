<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Client'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'client_id',
            'first_name',
            'last_name',
            [
				'attribute' => 'clientType',
				'value' => 'clientType.type',
				'label' => Yii::t('app', 'Client Type ID'),
			],
			[
				'attribute' => 'discipline',
				'value' => 'discipline.name',
				'label' => Yii::t('app', 'Discipline ID'),
			],
            [
				'attribute' => 'active',
				'value' => function ($model, $key, $index, $column) {
					return ($model->active) ? 'Si' : 'No';
				} ,
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
