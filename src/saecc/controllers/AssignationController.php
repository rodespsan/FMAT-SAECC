<?php

namespace app\controllers;

use Yii;
use app\models\Assignation;
use app\models\AssignationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Location;
use app\models\Equipment;
use app\models\Room;
use app\models\Client;

/**
 * AssignationController implements the CRUD actions for Assignation model.
 */
class AssignationController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['post'],
                ],
            ],
			'access' => [
				'class' => 'yii\filters\AccessControl',
				'rules' => [
					[
						'allow' => true,
						'actions' => ['index', 'view', 'update', 'delete', 'create', 'terminate', 'list-locations',
									'show-inventory', 'extend', 'assignations', 'get-location-room', 'create3'],
						'roles' => ['Básico', 'Operador', 'Administrador'],
					],
				],
			],
        ];
    }

    /**
     * Lists all Assignation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssignationSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['like', 'assignation.date', date('Y-m-d')]);
		
		$this->layout = '/main2';
		return $this->render('index', [		
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	public function actionAssignations()
    {
        $searchModel = new AssignationSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);		
		$this->layout = '/main2';
        return $this->render('assignations', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
    /**
     * Displays a single Assignation model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
		$this->layout = '/main2';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Assignation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionCreate($room_id = null, $location_id = null)
    {
        $model = new Assignation();
		$model->room_id = Room::find()->where(['name'=>Yii::$app->params['defaultRoom']])->one()->id;
		
		if( !empty($room_id) )
			$model->room_id = $room_id;
		
		if( !empty($location_id) )
		{
			$model->location_id = $location_id;
			$equipment = Equipment::find()->where(['location_id'=>$location_id,'available'=>1])->one();
			$model->equipment_id = (empty($equipment))? null : $equipment->id;
			
			if(empty($room_id)){
				$model->room_id = $equipment->location->room_id;
			}
		}
		
		$this->layout = '/main2';
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
    /**
     * Updates an existing Assignation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$this->layout = '/main2';
        
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
			return $this->redirect(['index']);				
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

	public function actionListLocations($id)
	{
		$locations = Location::find()->where(['room_id'=>$id])->all();
		echo "<option value=''>".Yii::t('app', 'Selecciona una Ubicación..')."</option>";
		foreach($locations as $location)
			echo "<option value='".$location->id."'>".$location->location."</option>";
	}		
	
	public function actionShowInventory($id)
	{
		$equipments = Equipment::find()->where(['location_id'=>$id])->all();
		//echo "<option value=''>".Yii::t('app', 'Selecciona un Número de Inventario...')."</option>";
		foreach($equipments as $equipment)
			echo "<option value='".$equipment->id."'>".$equipment->nameWithInventory."</option>";		
	}
	
	//Actualiza la hora final y la duración de una asignación en base a la hora en que se de por terminada una asignación
	public function actionTerminate($id)
	{
		date_default_timezone_set(Yii::$app->formatter->timeZone);
		
		$model = $this->findModel($id);
		
		$dateBegin = $model->date;
		$dateEnd = date('Y-m-d H:i:s');
		
		$timeBegin = strtotime($dateBegin);
		$timeEnd = strtotime($dateEnd);
		
		$diff = (int)(($timeEnd - $timeBegin)/60);
		
		$model->end_time = $dateEnd;
		$model->duration = $diff;
		$model->save();	
		return $this->redirect(['index']);
	}

	public function actionExtend()
	{
		$post = Yii::$app->request->post();
		
		if( isset($post['Assignation']['id']) && isset($post['Assignation']['duration']) ){
			$model = $this->findModel($post['Assignation']['id']);
			$extension = $post['Assignation']['duration'];
			
			switch($extension)
			{
				case 15:
					$model->end_time = date('H:i:s',strtotime( '+15 min' , strtotime ($model->end_time)));
					$model->duration = $model->hoursToMinutes(date('H:i',strtotime($model->end_time))) - $model->hoursToMinutes(date('H:i',strtotime($model->start_time)));
					break; 
				case 30: $model->end_time = date('H:i:s',strtotime( '+30 min' , strtotime ($model->end_time)));
					$model->duration = $model->hoursToMinutes(date('H:i',strtotime($model->end_time))) - $model->hoursToMinutes(date('H:i',strtotime($model->start_time)));
					break;
				case 45: $model->end_time = date('H:i:s',strtotime( '+45 min' , strtotime ($model->end_time)));
					$model->duration = $model->hoursToMinutes(date('H:i',strtotime($model->end_time))) - $model->hoursToMinutes(date('H:i',strtotime($model->start_time)));
					break;
				case 60: $model->end_time = date('H:i:s',strtotime( '+60 min' , strtotime ($model->end_time)));
					$model->duration = $model->hoursToMinutes(date('H:i',strtotime($model->end_time))) - $model->hoursToMinutes(date('H:i',strtotime($model->start_time)));
					break;
				case 90: $model->end_time = date('H:i:s',strtotime( '+90 min' , strtotime ($model->end_time)));
					$model->duration = $model->hoursToMinutes(date('H:i',strtotime($model->end_time))) - $model->hoursToMinutes(date('H:i',strtotime($model->start_time)));
					break;
				case 120: $model->end_time = date('H:i:s',strtotime( '+120 min' , strtotime ($model->end_time)));
					$model->duration = $model->hoursToMinutes(date('H:i',strtotime($model->end_time))) - $model->hoursToMinutes(date('H:i',strtotime($model->start_time)));
					break; 
			}
			$model->save();
			
			return $this->redirect(['index']);
		}else{
			throw new BadRequestHttpException('The requested page have a bad value.');
		}
	}
	
	public function actionGetLocationRoom($id)
	{
		echo Location::find()->orderBy('location ASC')->where(['id' => $id])->one()->room_id;
	}
	
    /**
     * Deletes an existing Assignation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Assignation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Assignation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assignation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionCreate3($id)
    {
        $model = new Assignation();
		$model->client_id = $id;		
		$this->layout = '/main2';
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
}
