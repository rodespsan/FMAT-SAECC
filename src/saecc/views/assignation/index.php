<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use app\models\Assignation;
use yii\helpers\ArrayHelper;
use app\models\Room;
use app\models\Location;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssignationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Assignations');
//$this->params['breadcrumbs'][] = $this->title;
?>
	<h1 align="center"><?= Html::a(Yii::t('app', 'Create Assignation'), ['create'], ['id' => 'openAssignation','class' => 'btn btn-success', 'style' => 'margin-left:-100px; margin-right:63px;']),
		'Asignaciones',
		Html::a('Salir', ['/client'], ['class' => 'btn btn-warning btn-md', 'style' => 'float:right; margin-left:4px;']),
		Html::a('', ['assignations'],['class' => 'btn btn-primary btn-md glyphicon glyphicon-calendar', 'style' => 'float:right; margin-left:4px;']),
		Html::a('', ['index'], ['class' => 'btn btn-primary btn-md glyphicon glyphicon-refresh', 'style' => 'float:right;'])
	?></h1>		
	
	<div class="assignation-index">
	
	<p></p>
	
	<?php
	$locationQuery = Location::find()->joinWith(['room'])->where(['location.active' => 1, 'room.available' => 1]);
	if(!empty(Yii::$app->request->queryParams['AssignationSearch']) && !empty(Yii::$app->request->queryParams['AssignationSearch']['room']))
	{
		$locationQuery->andWhere(['room.id' => Yii::$app->request->queryParams['AssignationSearch']['room']]);
	}
	?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'room',
				'value' => 'room.name',
				'label' => Yii::t('app', 'Room ID'),				
				'filter' => ArrayHelper::map(
					Room::find()->orderBy('name ASC')->where(['available' => 1])->all(),
					'id',
					'name'	
				),
				'filterInputOptions' => [
					'id' => 'search-assignation-room-id',
					'class' => 'form-control',
					//'options'=>['1'=>['Selected'=>true]]
				],				
			],				
            //'location_id',
			[
				'attribute' => 'location',
				'value' => 'location.location',
				'label' => Yii::t('app', 'Location ID'),
				'filter' => ArrayHelper::map(					
					$locationQuery->orderBy('name ASC')->all(),
					'id',
					'fullLocation'
				),
				'filterInputOptions' => [
					'id' => 'search-assignation-location-id',
					'class' => 'form-control'
				],
			],
			
            //'id',
            //'date',
            //'client_id',
			[
				'attribute' => 'client',
				'value' => 'client.client_id',
				'label' => Yii::t('app', 'Client ID'),
			],
			//'full_name',
			[				
				'attribute' => 'full_name',
				'value' => 'client.full_name',
				'label' => Yii::t('app', 'Full Name'),
			],
            //'room_id',
			
            //'equipment_id',
			/* [
				'attribute' => 'equipment',
				'value' => 'equipment.inventory',
				'label' => Yii::t('app', 'Inventory'),
			], */
            //'purpose',
            //'duration',
            'start_time',
            'end_time',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => ' {view} {update} {delete} {extend_time} {terminate} {report}',
				'buttons' => [										
					'view' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,
						[
								'title' => Yii::t('app', 'View'),
						]);
					},
					'update' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
						[
								'title' => Yii::t('app', 'Update'),
						]);
					},
					'delete' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
						[
								'title' => Yii::t('app', 'Delete'),
								'data-confirm'=>'¿Borrar esta asignación?',
                                'data-method'=>'POST'
						]);
					},
					//Actualiza la hora final y la duración de una asignación en base a los minutos que se extienda la asignación
					'extend_time' => function ($url, $model, $key) {						
						return Html::a('<a data-toggle="modal" href="#extendTime" data-model="'.$model->id.'"><span class="glyphicon glyphicon-time"></span></a>', $url);					
					},
					//Actualiza la hora final y la duración de una asignación en base a la hora en que se de por terminada una asignación
					'terminate' => function ($url, $model, $key) {						
						return Html::a('<span class="glyphicon glyphicon-pause"></span>', $url, 
						[
							'title' => Yii::t('app', 'Terminate assignation'),
						]);
					},
					'report' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-alert"></span>', $url, 
						[
							'title' => Yii::t('app', 'report an incident'),
						]);
					},
				],
				'urlCreator' => function ($action, $model, $key, $index) {																				
					if ($action === 'view') {						
						return Url::to(['assignation/view?id=' . $model->id]);
					}
					if ($action === 'update') {						
						return Url::to(['assignation/update?id=' . $model->id]);
					}
					if ($action === 'delete') {						
						return Url::to(['assignation/delete?id=' . $model->id]);						
					}
					//Actualiza la hora final y la duración de una asignación en base a los minutos que se extienda la asignación
					if ($action === 'extend_time') {											
						Modal::begin([
							'header' => '<h2 align="center">Extensión de Tiempo de Asignación</h2>',
							'id' => 'extendTime',
							//'toggleButton' => ['label' => 'click me'],
						]);
							$form = ActiveForm::begin([
								'action' => Url::to(['extend']),
								'options' => ['enctype' => 'multipart/form-data'],				
							]);
								$model = new Assignation();
								
								echo $form->field($model, 'id')->hiddenInput()->label(false);
								
								echo $form->field($model, 'duration')->dropDownList(
										[15 => '15 min.', 30 => '30 min.', 45 => '45 min.', 60 => '1:00', 90 => '1:30 ', 120 => '2:00'],
										[
											'prompt' => Yii::t('app','Selecciona una opción...'),
										]
										);
										
								echo '<hr>';
								echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Extender') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
								echo '<button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right;">Cancelar</button>';
							ActiveForm::end();						   
						Modal::end();
					}					
					//Actualiza la hora final y la duración de una asignación en base a la hora en que se de por terminada una asignación
					if ($action === 'terminate') {
						return Url::to(['assignation/terminate?id=' . $model->id]);
					}					
					if ($action === 'report') {
						return Url::to(['incident/create-from-assignation?id=' . $model->id]);
					}					
				}
			],
        ],
    ]); ?>

</div>

<?php $this->registerJs("
		$('#extendTime').on('show.bs.modal', function (event) {	
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('model') // Extract info from data-* attributes
			var modal = $(this)
			modal.find('#assignation-id').val(recipient);
		});
	");
?>

<?php $this->registerJs(' $(document).ready(function(){
		$("#openAssignation").click(function(){
			roomId = $("[name=\'AssignationSearch[room]\']").val()
			locationId = $("[name=\'AssignationSearch[location]\']").val()
			if( roomId != "" || locationId != "" )
			{
				this.href = this.href + "?";
				if( roomId != "" )
					this.href = this.href + "room_id=" + roomId;
				if( roomId != "" && locationId != "" )
					this.href = this.href + "&"
				if( locationId != "" )
					this.href = this.href + "location_id=" + locationId;
			}
			return true;
		});
	}); 
');?>
