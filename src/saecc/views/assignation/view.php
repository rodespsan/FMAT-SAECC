<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Assignation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Assignations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'client_id',
            'equipment_id',
            'location',
            'room_id',
            'start_date',
            'end_date',
            'duration',
            'purpose',
        ],
    ]) ?>

</div>
