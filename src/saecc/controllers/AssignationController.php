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
									'show-inventory', 'extend', 'create-room', 'create-location', 'create-client', 'assignations', 'get-location-room'],
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
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	public function actionAssignations()
    {
        $searchModel = new AssignationSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);		
		
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Assignation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Assignation();

        /* if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        } */
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        }/*  else {
            return $this->render('index');
        } */
    }

	public function actionCreateRoom()
    {
        $model = new Room();
		// $model->available=true;
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
    }
	
	public function actionCreateLocation()
    {
        $model = new Location();
		// $model->available=true;
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
    }
	
	public function actionCreateClient()
    {
        $model = new Client();
		// $model->available=true;
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
			echo "<option value='".$equipment->id."'>(".$equipment->inventory. ") ". $equipment->equipmentType->name ."</option>";		
	}
	
	//Actualiza la hora final y la duración de una asignación en base a la hora en que se de por terminada una asignación
	public function actionTerminate($id)
	{
		$model = $this->findModel($id);
		$model->end_time = date('H:i');
		$model->duration = $model->hoursToMinutes(date('H:i',strtotime($model->end_time)))
				- $model->hoursToMinutes(date('H:i',strtotime($model->start_time)));									
		$model->end_time = new \yii\db\Expression('NOW()');
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
		echo Location::find()->where(['id' => $id])->one()->room_id;
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
}
