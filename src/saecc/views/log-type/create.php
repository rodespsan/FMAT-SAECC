<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LogType */

$this->title = 'Create Log Type';
$this->params['breadcrumbs'][] = ['label' => 'Log Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
