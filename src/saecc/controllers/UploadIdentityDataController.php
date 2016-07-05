<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadIdentityData;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\filters\VerbFilter;

class UploadIdentityDataController extends Controller
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
						'actions' => ['upload'],
						'roles' => ['Administrador'],
					],
				],
			],
		];
	}
	
    public function actionUpload()
    {	
        $model = new UploadIdentityData();		

        if (Yii::$app->request->isPost) {			
            $model->csvFile = UploadedFile::getInstance($model, 'csvFile');			
            if ($model->upload()) {				
				Yii::$app->session->setFlash('success', Yii::t('app','El archivo se cargó correctamente.'));
				return $this->redirect(Url::to(['/upload-identity-data/upload']));				
            } 
        }
		
        return $this->render('upload', ['model' => $model]);
    }
}

?>
