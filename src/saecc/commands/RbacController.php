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
		
		public function actionTwo()
		{
			$auth = Yii::$app->authManager;
			$normaluser = $auth->createRole('normaluser');
			$auth->add($normaluser);
			$auth->assign($normaluser, 2);
			$auth->assign($normaluser, 3);
			$auth->assign($normaluser, 4);
		}
		
		public function actionThree()
		{
			$auth = Yii::$app->authManager;
			$operator = $auth->createRole('operator');
			$auth->add($operator);
			$auth->assign($operator, 5);
			$auth->assign($operator, 6);
			$auth->assign($operator, 7);
		}
	}

?>