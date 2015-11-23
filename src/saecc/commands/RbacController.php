<?php
	namespace app\commands;
	
	use Yii;
	use yii\console\Controller;
	
	class RbacController extends Controller
	{
		public function actionInit()
		{
			$auth = Yii::$app->authManager;
			$administrator = $auth->createRole('administrator');
			$auth->add($administrator);
			$auth->assign($administrator, 1);
		}
	}

?>