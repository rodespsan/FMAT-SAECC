<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DisciplineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Disciplines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discipline-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Discipline', ['create'], ['class' => 'btn btn-success']) ?>
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
				'label' => 'Area',
			],
			//'school.name',
			[
				'attribute' => 'school',
				'value' => 'school.name',
				'label' => 'School',
			],
			

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
