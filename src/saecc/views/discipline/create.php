<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Discipline */

$this->title = Yii::t('app', 'Create Discipline');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disciplines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discipline-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
