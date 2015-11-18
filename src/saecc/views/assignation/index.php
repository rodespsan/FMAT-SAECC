<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssignationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assignations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Assignation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'client_id',
            'equipment_id',
            'location',
            'room_id',
            'start_date',
            'end_date',
            'duration',
            'purpose',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
