<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\bootstrap\Alert;
//use yii\widgets\ActiveForm;
use app\models\Assignation;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Room;
use app\models\Location;
use app\models\Area;
use kartik\widgets\Select2;
use app\models\Client;
use app\models\Equipment;
use yii\jui\AutoComplete;
use app\models\ClientType;
use app\models\Discipline;

use kartik\widgets\TimePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssignationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Assignations');
//$this->params['breadcrumbs'][] = $this->title;
?>
	
	<h1><?= Html::encode($this->title) ?></h1>
	<a id="mas" data-toggle="modal" href="#createAssignation" class="btn btn-success">Crear Asignación</a>
	
	<?= Html::a('', ['assignations'], ['class' => 'btn btn-primary btn-md glyphicon glyphicon-calendar', 'style' => 'float:right;']) ?>
	
	<?= Html::a('', ['index'], ['class' => 'btn btn-primary btn-md glyphicon glyphicon-refresh', 'style' => 'float:right;']) ?>
	
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
			[
				'attribute' => 'room',
				'value' => 'room.name',
				'label' => Yii::t('app', 'Room ID'),
				'filter' => ArrayHelper::map(
					Room::find()->where(['available' => 1])->all(),
					'id',
					'name'
				),
			],
            //'location_id',
			[
				'attribute' => 'location',
				'value' => 'location.location',
				'label' => Yii::t('app', 'Location ID'),
				'filter' => ArrayHelper::map(
					//Location::find()->all(),
					//Location::find()->joinWith(['assignations'])->where(['like', 'assignation.date', date('Y-m-d')])->all(),
					//Location::find()->joinWith(['room'])->where(['location.active' => 1, 'room.available' => 1])->all(),
					$locationQuery->all(),
					'id',
					'fullLocation'
				),
				'filterInputOptions' => [
					'id' => 'search-assignation-location-id',
					'class' => 'form-control'
				],
			],
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
											'prompt' => Yii::t('app','Select an extensión period'),
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

<?php Modal::begin([
		'header' => '<h1 align="center">Crear Asignación</h1>',
		'id' => 'createAssignation',
		'size' => 'modal-lg',		
		//'toggleButton' => ['label' => '<span class="glyphicon glyphicon-plus"></span>', 'class'=>'btn btn-info btn-xs'],							
		//'footer' => '<button type="submit" formaction="action">Submit as admin</button><button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right;">Cancelar</button>',
	]);
?>

<?php $this->registerJs("
	$('#createAssignation').removeAttr('tabindex');
"); ?>

<div class="form-assign center-block">

	<?php $form = ActiveForm::begin([
		//'layout' => 'inline',
		'action' => Url::to(['create']),
		'options' => ['enctype' => 'multipart/form-data'],
		/* 'fieldConfig' => [
			'template' => "{label}\n{input}",
			'horizontalCssClasses' => [
				'label' => 'col-sm-3',			
				//'offset' => 'col-sm-3',
				//'wrapper' => 'col-sm-10',
				//'error' => '',
				//'hint' => 'col-sm-10',
			],
		], */
	]);
	$model = new Assignation();
	$model->room_id = Room::find()->where(['name'=>Yii::$app->params['defaultRoom']])->one()->id;
	?>
	
	<?= $form->field($model, 'client_id')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(
			Client::find()->all(),
			'id',
			'searchableName'
		),
		'options' => ['placeholder' => 'Selecciona un Cliente...'],
		'pluginOptions' => [
			'width' => '349px',
			'allowClear' => true,
		]
	]); ?>
	<a id="mas" data-toggle="modal" href="#createClient" class="btn btn-info btn-xs btn-right"><span class="glyphicon glyphicon-plus"></span></a>
	<br>
	
	<?= $form->field($model, 'room_id')->dropDownList(
		ArrayHelper::map(
			Room::find()->where(['available' => 1])->all(),
			'id',
			'name'
		),
		[	
			'prompt' => 'Selecciona un Salón...',
			'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('assignation/list-locations?id=').'"+$(this).val(), function(data){
				$("#assignation-location_id").html(data);
			})',
		]
	)
	?>		
	
	<br>
	<?= $form->field($model, 'location_id')->dropDownList(
			ArrayHelper::map(
				Location::find()->where(['room_id' => $model->room_id])->all(),
				'id',
				'location'
			),
			[
				'prompt' => 'Selecciona una Ubicación...',
				'onchange' => '$.post("'.Yii::$app->urlManager->createUrl('assignation/show-inventory?id=').'"+$(this).val(), function(data){
					$("#assignation-equipment_id").html(data);
					//$("#search-assignation-location-id").val($("#assignation-location_id").val());
				})',
			]
		)
	?>
	
	<br>
	<?= $form->field($model, 'equipment_id')->dropDownList(
			[],
			[
				'prompt' => 'Selecciona un Número de Inventario...',
			]
		)
	?>
	<br>
	<?= $form->field($model, 'purpose')->textarea(['maxlength' => 170]) ?>
	<br>
	<div id="hora" class="form-inline form-group">
	<?= $form->field($model, 'start_time')->widget(TimePicker::classname(), [
			//'type'=>DateTimePicker::TYPE_INPUT,
			//'convertFormat' => true,
			'options' => ['readonly' => true],
			'pluginOptions' => [
				'minuteStep' => 1,
				'showMeridian' => false,
				'showSeconds' => true,
				'defaultTime' => '0'
				//'autoclose' => true,
				//'template' => false,
				//'format' => 'H:ii:s'
				//'todayBtn' => true,				
			],
			
		]);
	?><p id="reserva"><b>* sólo para reservaciones.</b></p>
	</div>
	<?= $form->field($model, 'duration')->dropDownList(
		[15 => '15 min.', 30 => '30 min.', 45 => '45 min.', 60 => '1:00', 90 => '1:30 ', 120 => '2:00'],
		[
			'prompt' => Yii::t('app','Selecciona un Periodo de Tiempo...'),
		]
		)
	?>
	
	<!--?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create Assignation') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-right' : 'btn btn-primary']) ?-->	
	
	<hr>
	<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	<button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right;">Cancelar</button>
	
	<?php ActiveForm::end(); ?>
	
</div>
<?php Modal::end();?>

<?php Modal::begin([
		'header' => '<h1 align="center">Crear Cliente</h1>',
		'id' => 'createClient',			
		//'toggleButton' => ['label' => '<span class="glyphicon glyphicon-plus"></span>', 'class'=>'btn btn-info btn-xs'],							
		//'footer' => '<button type="submit" formaction="action">Submit as admin</button><button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right;">Cancelar</button>',
	]);
		$form = ActiveForm::begin([
			'action' => Url::to(['create-client']),
			'options' => ['enctype' => 'multipart/form-data'],				
		]);
			$model = new Client();
			$model->active = true;

			echo $form->field($model, 'client_id')->textInput(['maxlength' => 30]);
			echo $form->field($model, 'full_name')->textInput(['maxlength' => 175]);			
			echo $form->field($model, 'client_type_id')->inline()->radioList(
				ArrayHelper::map(
					ClientType::find()->all(),
					'id',
					'type'));
			echo $form->field($model, 'discipline_id')->dropDownList(
				ArrayHelper::map(
					Discipline::find()->all(),
					'id',
					'name'));	
			echo $form->field($model, 'active')->checkbox([],false);
							
			echo '<hr>';
			echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
			echo '<button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right;">Cancelar</button>';
		ActiveForm::end();
	Modal::end();
?>

<?php Modal::begin([
		'header' => '<h1 align="center">Crear Salón</h1>',
		'id' => 'createRoom',			
		//'toggleButton' => ['label' => '<span class="glyphicon glyphicon-plus"></span>', 'class'=>'btn btn-info btn-xs'],							
		//'footer' => '<button type="submit" formaction="action">Submit as admin</button><button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right;">Cancelar</button>',
	]);
		$form = ActiveForm::begin([
			'action' => Url::to(['create-room']),
			'options' => ['enctype' => 'multipart/form-data'],				
		]);
			$model = new Room();
			$model->available = true;

			echo $form->field($model, 'name')->textInput(['maxlength' => 45]);
			echo $form->field($model, 'available')->checkbox([],false);
			
			echo '<hr>';
			echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
			echo '<button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right;">Cancelar</button>';
		ActiveForm::end();
	Modal::end();
?>

<?php Modal::begin([
		'header' => '<h1 align="center">Crear Ubicación</h1>',
		'id' => 'createLocation',			
		//'toggleButton' => ['label' => '<span class="glyphicon glyphicon-plus"></span>', 'class'=>'btn btn-info btn-xs'],							
	]);
		$form = ActiveForm::begin([
			'action' => Url::to(['create-location']),
			'options' => ['enctype' => 'multipart/form-data'],
		]);
			$model = new Location();
			$model->active = true;

			echo $form->field($model, 'location')->textInput(['maxlength' => true]);
			echo $form->field($model, 'room_id')->dropDownList(
				ArrayHelper::map(
					Room::find()->all(),
					'id',
					'name'));
			echo $form->field($model, 'active')->checkbox([],false);	

			echo '<hr>';
			echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
			echo '<button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right;">Cancelar</button>';
		ActiveForm::end();
	Modal::end();
?>

<?php $this->registerJs('

	function toggleDiscipline()
	{
		var clientType = $("[name=\'Client[client_type_id]\']:checked").val();
		switch( clientType )
		{
			case "1": $("[name=\'Client[discipline_id]\']").removeAttr("disabled");
			$(".field-client-discipline_id").show();
			break; 
			case "2": 
			case "3":
			case "4": $("[name=\'Client[discipline_id]\']").attr("disabled","disabled");
			$(".field-client-discipline_id").hide();
			break;
		}
	}

	$("[name=\'Client[client_type_id]\']").change(function(){
		toggleDiscipline();	
	});

	toggleDiscipline();	
	');
?>

<?php $this->registerJs("
		$('#extendTime').on('show.bs.modal', function (event) {	
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('model') // Extract info from data-* attributes
			var modal = $(this)
			modal.find('#assignation-id').val(recipient);
		});
	");
?>

<?php $this->registerJs("
		$('#createAssignation').on('show.bs.modal', function (event) {	
			var button = $(event.relatedTarget) // Button that triggered the modal
			var modal = $(this)
			roomId = $(\"[name='AssignationSearch[room]']\").val()
			locationId = $(\"[name='AssignationSearch[location]']\").val()
			if(roomId != ''){
				$('#assignation-room_id').val( roomId );
				$.post('".Yii::$app->urlManager->createUrl('assignation/list-locations?id=')."'+ roomId, function(data){
					$('#assignation-location_id').html(data);
					
					//alert(locationId);
					$('#assignation-location_id').val( locationId );
					$.post('".Yii::$app->urlManager->createUrl('assignation/show-inventory?id=')."'+ locationId, function(data){
						$('#assignation-equipment_id').html(data);
					})
				});
			}else{
				if( locationId != '' ){
					$.post('".Yii::$app->urlManager->createUrl('assignation/get-location-room?id=')."'+ locationId, function(data){
						roomId = data;
						$('#assignation-room_id').val( roomId );
						$.post('".Yii::$app->urlManager->createUrl('assignation/list-locations?id=')."'+ roomId, function(data){
							$('#assignation-location_id').html(data);
							
							//alert(locationId);
							$('#assignation-location_id').val( locationId );
							$.post('".Yii::$app->urlManager->createUrl('assignation/show-inventory?id=')."'+ locationId, function(data){
								$('#assignation-equipment_id').html(data);
							})
						});
					})
				}
			}
			
			
		});
	");
?>
