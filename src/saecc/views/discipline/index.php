<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DisciplineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Disciplines');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discipline-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Discipline'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',            
            'name',
            'short_name',
			//'area.name',
			[
				'attribute' => 'area',
				'value' => 'area.name',
				'label' => Yii::t('app', 'Area'),
			],
			//'school.name',
			[
				'attribute' => 'school',
				'value' => 'school.name',
				'label' => Yii::t('app', 'School'),
			],
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
