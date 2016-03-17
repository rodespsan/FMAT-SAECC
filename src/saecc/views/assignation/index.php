<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use yii\bootstrap\Modal;
use yii\bootstrap\Alert;
use yii\helpers\VarDumper ;



use yii\widgets\ActiveForm;
//use app\models\Assignation;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssignationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Assignations');
$this->params['breadcrumbs'][] = $this->title;
?>





<div class="container">
  <!-- <h2>Modal Example</h2>-->
  <!-- Trigger the modal with a button -->
  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Extensión de Tiempo</h4>
        </div>
        <div class="modal-body">          		 
			<select>
				<option value="0">Selecciona una opción...</option>
				<option value="15">15 min.</option>
				<option value="30">30 min.</option>
				<option value="45">45 min.</option>
				<option value="60">60 min.</option>
				<option value="90">1:30 min.</option>
				<option value="120">2:00 hr.</option>
			</select>
        </div>
        <div class="modal-footer">
			<button type="button" class="btn btn-success">Extender</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>			
        </div>
      </div>
      
    </div>
  </div>
  
</div>







<div class="assignation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Assignation'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'date',
            //'client_id',
			[
				'attribute' => 'client',
				'value' => 'client.client_id',
				'label' => Yii::t('app', 'Client ID'),
			],
            //'room_id',
			[
				'attribute' => 'room',
				'value' => 'room.name',
				'label' => Yii::t('app', 'Room ID'),
			],
            //'location_id',
			[
				'attribute' => 'location',
				'value' => 'location.location',
				'label' => Yii::t('app', 'Location ID'),
			],
            //'equipment_id',
			[
				'attribute' => 'equipment',
				'value' => 'equipment.inventory',
				'label' => Yii::t('app', 'Inventory'),
			],
            'purpose',
            'duration',
            'start_time',
            'end_time',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => ' {update} {extend_time} {terminate} {report}',
				'buttons' => [
					//Actualiza la hora final y la duración de una asignación en base a la hora en que se de por terminada una asignación
					'terminate' => function ($url, $model, $key) {						
						return Html::a('<span class="glyphicon glyphicon-pause"></span>', $url, 
						[
							'title' => Yii::t('app', 'Terminate assignation'),
						]);
					},
					
					'update' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
						[
								'title' => Yii::t('app', 'Update'),
						]);
					},
					//Actualiza la hora final y la duración de una asignación en base a los minutos que se extienda la asignación
					'extend_time' => function ($url, $model, $key) {						
						//return Html::a('<span class="glyphicon glyphicon-time"></span>', $url,
						return Html::a('<a data-toggle="modal" href="#myModal2"><span class="glyphicon glyphicon-time"></span></a>', $url);
						/* return Html::a('<span class="glyphicon glyphicon-time" data-toggle="modal" href="#myModal2"></span>', $url,
						[
								'title' => Yii::t('app', 'Exntend Time'),
						]); */
						//VarDumper::dump($model->id);
					},
					'report' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-alert"></span>', $url, 
						[
							'title' => Yii::t('app', 'report an incident'),
						]);
					},
				],
				'urlCreator' => function ($action, $model, $key, $index) {																				
					if ($action === 'update') {						
						return Url::to(['assignation/update?id=' . $model->id]);
					}
					
					//Actualiza la hora final y la duración de una asignación en base a la hora en que se de por terminada una asignación
					if ($action === 'terminate') {
						return Url::to(['assignation/terminate?id=' . $model->id]);
					}
					
					//Actualiza la hora final y la duración de una asignación en base a los minutos que se extienda la asignación
					if ($action === 'extend_time') {											
						/* echo Alert::widget([
							'options' => [
								'class' => 'alert-info',
							],
							'body' => 'Say hello...',	
						]); */
						//VarDumper::dump($model->id);

						Modal::begin([
							'header' => '<h2>Extensión de Asignación</h2>',
							'id' => 'myModal2',
							//'toggleButton' => ['label' => 'click me'],
						]);
							$form = ActiveForm::begin();
								echo $form->field($model, 'duration')->dropDownList(
										[15 => '15 min.', 30 => '30 min.', 45 => '45 min.', 60 => '1:00', 90 => '1:30 ', 120 => '2:00'],
										[
											'prompt' => Yii::t('app','Select an extensión period'),
										]
										);
								'<br><br><button type="button" onclick="alert()" class="btn btn-success">Extender</button>';
								echo '<button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right;">Cancelar</button>';

								echo Html::a(Yii::t('app', 'Extend'), ['extend', 'id' => $model->id], ['class' => 'btn btn-primary']);

								Html::a(Yii::t('app', 'Create Assignation'), ['create'], ['class' => 'btn btn-success']);
									   
								Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
								//VarDumper::dump($model->id);
							ActiveForm::end();						   
						Modal::end();

						//return Url::to(['assignation/index']);
						//return $this->redirect(['index']);
						/* return $this->render('view', [
							'model' => $model,
						]); */
					}
					
					if ($action === 'report') {
						return Url::to(['incident/create']);
						//return $this->redirect(['index']);
						/* return $this->render('view', [
							'model' => $model,
						]); */
					}
				}
			],
        ],
    ]); ?>

</div>
