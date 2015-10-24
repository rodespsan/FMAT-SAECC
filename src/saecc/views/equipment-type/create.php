<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EquipmentType */

$this->title = 'Create Equipment Type';
$this->params['breadcrumbs'][] = ['label' => 'Equipment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
