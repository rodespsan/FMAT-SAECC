<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Areas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Area'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
			[
				'attribute' => 'active',
				'value' => function ($model, $key, $index, $column) {
					return ($model->active) ? 'Si' : 'No';
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
