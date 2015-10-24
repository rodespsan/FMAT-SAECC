<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Assignation */

$this->title = 'Create Assignation';
$this->params['breadcrumbs'][] = ['label' => 'Assignations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
