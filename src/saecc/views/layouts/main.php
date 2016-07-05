<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


//use yii\bootstrap\Alert;


/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
		<div class="header">
			<img src="<?= Url::to('@web/images/template/header.png') ?>" class="img-responsive" />
		</div>
		
        <?php
            NavBar::begin([
				/* 'brandLabel' => Yii::t('app',Yii::$app->name),
				'brandUrl' => Yii::$app->homeUrl, */
                'options' => [
                    //'class' => 'navbar-default navbar-top',
					'class' => 'navbar-inverse',
                ],
				
            ]);
            echo Nav::widget([
				'id' => 'nav',
                //'options' => ['class' => 'nav nav-pills'],
				'options' => ['class' => 'navbar-nav navbar-right'],
				
				
				//'background-image' => 'none',
                'items' => [
					//['label' => 'Client', 'url' => ['/client/index']],
					//Yii::$app->user->isGuest ?
                    //    ['label' => 'Client', 'url' => ['/site/login']] : ['label' => 'Client', 'url' => ['/client/index']],

					//Básico
					['label' => Yii::t('app', 'Assignation'), 'url' => ['/assignation/index'],
						'visible' => Yii::$app->user->can('Básico')],
					['label' => Yii::t('app', 'Client'), 'url' => ['/client/index'],
						'visible' => Yii::$app->user->can('Básico')],
					['label' => Yii::t('app', 'Incident'), 'url' => ['/incident/index'],
						'visible' => Yii::$app->user->can('Básico')],

					//Operador
					['label' => Yii::t('app', 'Assignation'), 'url' => ['/assignation/index'],
						'visible' => Yii::$app->user->can('Operador')],
					['label' => Yii::t('app', 'Client'), 'url' => ['/client/index'],
						'visible' => Yii::$app->user->can('Operador')],
					['label' => Yii::t('app', 'Incident'), 'url' => ['/incident/index'],
						'visible' => Yii::$app->user->can('Operador')],
					['label' => Yii::t('app', 'School'), 'url' => ['/school/index'],
						'visible' => Yii::$app->user->can('Operador')],
					['label' => Yii::t('app', 'Discipline'), 'url' => ['/discipline/index'],
						'visible' => Yii::$app->user->can('Operador')],
					/* ['label' => Yii::t('app', 'ClientType'), 'url' => ['/client-type/index'],
						'visible' => Yii::$app->user->can('Operador')], */
					['label' => Yii::t('app', 'Equipment'), 'url' => ['/equipment/index'],
						'visible' => Yii::$app->user->can('Operador')],
					['label' => Yii::t('app', 'Location'), 'url' => ['/location/index'],
						'visible' => Yii::$app->user->can('Operador')],
					['label' => Yii::t('app', 'Log'), 'url' => ['/log/index'],
						'visible' => Yii::$app->user->can('Operador')],

					//Administrador
					['label' => Yii::t('app', 'Assignation'), 'url' => ['/assignation/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'Client'), 'url' => ['/client/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'Incident'), 'url' => ['/incident/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'School'), 'url' => ['/school/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'Discipline'), 'url' => ['/discipline/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'Area'), 'url' => ['/area/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'ClientType'), 'url' => ['/client-type/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'Equipment'), 'url' => ['/equipment/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'EquipmentType'), 'url' => ['/equipment-type/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'EquipmentStatus'), 'url' => ['/equipment-status/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'Room'), 'url' => ['/room/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'Location'), 'url' => ['/location/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'Log'), 'url' => ['/log/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'LogType'), 'url' => ['/log-type/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					['label' => Yii::t('app', 'User'), 'url' => ['/user/index'],
						'visible' => Yii::$app->user->can('Administrador')],
					//['label' => Yii::t('app', 'User'), 'url' => ['/user/index'],
						//'visible' => Yii::$app->user->can('Administrador'), 'linkOptions' => ['class' => 'glyphicon glyphicon-user']],
																																					
                    //['label' => 'Home', 'url' => ['/site/index']],
					//['label' => Yii::t('app','Home'), 'url' => ['/site/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-home'], 'visible' => Yii::$app->user->isGuest],
                    //['label' => 'About', 'url' => ['/site/about']],
                    //['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => Yii::t('app','Login'), 'url' => ['/site/login'], 'linkOptions' => ['class' => 'glyphicon glyphicon-log-in']] :
						[
							'label' => Yii::t('app','Logout'),
							'url' => ['/site/logout'],
							'linkOptions' => ['data-method' => 'post', 'class' => 'glyphicon glyphicon-log-out']
						],
                ],
            ]);
            NavBar::end();
			
			
	/* 		echo Alert::widget([
    'options' => [
        'class' => 'alert-info',
    ],
    'body' => 'Say hello...',
]); */
        ?>
        
		<div class="container" style=" margin-top:-30px; max-width:1140px;">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-right">&copy; <a href="http://www.matematicas.uady.mx/">Facultad de Matemáticas - UADY</a> <?= date('Y') ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
