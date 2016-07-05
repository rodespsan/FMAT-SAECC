<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = Yii::t('app', 'Create Client');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-create">

    <h1 align="center"><?= Html::encode($this->title) ?></h1>
	<hr>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
