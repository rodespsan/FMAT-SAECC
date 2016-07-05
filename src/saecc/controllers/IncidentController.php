<?php

namespace app\controllers;

use Yii;
use app\models\Incident;
use app\models\IncidentSearch;
use app\models\Location;
use app\models\Equipment;
use app\models\EquipmentType;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\Assignation;


/**
 * IncidentController implements the CRUD actions for Incident model.
 */
class IncidentController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
			'access' => [
				'class' => 'yii\filters\AccessControl',
				'rules' => [
					[
						'allow' => true,
						'actions' => ['index', 'view', 'update', 'create', 'list-locations', 'list-equipment-types',
						'show-inventory', 'list-clients', 'create-from-assignation', 'get-equipment-information', 'view2'
							],
						'roles' => ['Básico', 'Operador', 'Administrador'],
					],
				],
			],
        ];
    }

    /**
     * Lists all Incident models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncidentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Incident model.
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
     * Creates a new Incident model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Incident();
		$model->solved = false;
		$model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

	public function actionCreateFromAssignation($id)
    {
        $model = new Incident();
		$model->solved = false;
		$model->user_id = Yii::$app->user->id;
		
		$assignationmodel = new Assignation();
		$assignationmodel = Assignation::findOne($id);
		$model->date = $assignationmodel->date;
		$model->equipment_id = $assignationmodel->equipment_id;
		$model->room_id = $assignationmodel->room_id;
		$model->location_id = $assignationmodel->location_id;
		$model->client_id = $assignationmodel->client_id;		
		$this->layout = '/main2';
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view2', 'id' => $model->id]);
        } else {
            return $this->render('create2', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionView2($id)
    {
		$this->layout = '/main2';
        return $this->render('view2', [
            'model' => $this->findModel($id),
        ]);
    }
	
    /**
     * Updates an existing Incident model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->location_id = $model->equipment->location_id;
		$model->equipment_type_id = $model->equipment->equipment_type_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Incident model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionListLocations($id)
	{
		$locations = Location::find()->where(['room_id'=>$id])->all();
		echo "<option value=''>".Yii::t('app', 'Choose an option')."</option>";
		foreach($locations as $location)
			echo "<option value='".$location->id."'>".$location->location."</option>";
	}

	public function actionListEquipmentTypes($id)
	{
		$equipments = Equipment::find()->where(['location_id'=>$id])->all();
		echo "<option value=''>".Yii::t('app', 'Choose an option')."</option>";
		foreach($equipments as $equipment)
			//echo "<option value='".$equipment->id."'>".$equipment->equipment_type_id."</option>";		
			echo "<option value='".$equipment->id."'>".$equipment->nameWithInventory."</option>";
			//echo "<option value='".$equipment->id."'>".$equipment->equipment.equipment_type."</option>";
	}
	
	public function actionShowInventory($id)
	{
		$equipment = Equipment::find()->where(['id'=>$id])->one();
		echo $equipment->id;
	}
	
	public function actionGetEquipmentInformation($id)
	{
		$equipment = Equipment::find()->where(['id'=>$id])->one();
		if(empty($equipment))
			throw new NotFoundHttpException('The requested page does not exist.');
		echo Json::encode([
			'room_id' => $equipment->location->room_id,
			'location_id' => $equipment->location_id,
			'equipment_id' => $equipment->id,
		]);
	}
	
    /**
     * Finds the Incident model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Incident the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Incident::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
