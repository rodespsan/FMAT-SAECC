<?php

namespace app\controllers;

use Yii;
use app\models\Equipment;
use app\models\Log;
use app\models\EquipmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Location;

/**
 * EquipmentController implements the CRUD actions for Equipment model.
 */
class EquipmentController extends Controller
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
						'actions' => ['index', 'view', 'update', 'create', 'list-locations'],
						'roles' => ['@'],
					],
				],
			],
        ];
    }

    /**
     * Lists all Equipment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EquipmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Equipment model.
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
     * Creates a new Equipment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$model = new Equipment();	
		$model->available=true;
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			//Las siguientes líneas de código almacenan en la tabla Log información de acerca de las altas de equipos
			$modelLog = new Log();							
			$modelLog->user_id = Yii::$app->user->id;
			$modelLog->date = new \yii\db\Expression('NOW()');
			$modelLog->log_type_id = 1;			
			$modelLog->equipment_id = $model->id;			
			$modelLog->location_id = $model->location_id;			
			$modelLog->equipment_status_id = $model->equipment_status_id;
			$modelLog->save();			
			
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Equipment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			//Las siguientes líneas de código almacenan en la tabla Log información de acerca de las actualizaciones en los equipos
			$modelLog = new Log();
			$modelLog->user_id = Yii::$app->user->id;
			$modelLog->date = new \yii\db\Expression('NOW()');
			$modelLog->log_type_id = 3;
			$modelLog->equipment_id = $model->id;
			$modelLog->location_id = $model->location_id;
			$modelLog->equipment_status_id = $model->equipment_status_id;
			$modelLog->save();
			
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
		echo "<option value=''>".Yii::t('app', 'Choose an option')."</option>";
		foreach($locations as $location)
			echo "<option value='".$location->id."'>".$location->location."</option>";
	}
	
    /**
     * Deletes an existing Equipment model.
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
     * Finds the Equipment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Equipment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Equipment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
