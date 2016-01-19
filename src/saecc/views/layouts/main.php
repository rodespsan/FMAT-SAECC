<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
        <?php
            NavBar::begin([
                'options' => [
                    'class' => 'navbar-inverse navbar-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
					//['label' => 'Client', 'url' => ['/client/index']],
					//Yii::$app->user->isGuest ?
                    //    ['label' => 'Client', 'url' => ['/site/login']] : ['label' => 'Client', 'url' => ['/client/index']],
					
					//NormalUser
					['label' => Yii::t('app', 'Client'), 'url' => ['/client/index'],
						'visible' => Yii::$app->user->can('normaluser')],
					['label' => Yii::t('app', 'Assignation'), 'url' => ['/assignation/index'],
						'visible' => Yii::$app->user->can('normaluser')],
					['label' => Yii::t('app', 'Incident'), 'url' => ['/incident/index'],
						'visible' => Yii::$app->user->can('normaluser')],
					
					//Operator
					['label' => Yii::t('app', 'Client'), 'url' => ['/client/index'],
						'visible' => Yii::$app->user->can('operator')],						
					['label' => Yii::t('app', 'ClientType'), 'url' => ['/client-type/index'],
						'visible' => Yii::$app->user->can('operator')],
					['label' => Yii::t('app', 'Discipline'), 'url' => ['/discipline/index'],
						'visible' => Yii::$app->user->can('operator')],					
					['label' => Yii::t('app', 'School'), 'url' => ['/school/index'],
						'visible' => Yii::$app->user->can('operator')],
					['label' => Yii::t('app', 'Equipment'), 'url' => ['/equipment/index'],						
						'visible' => Yii::$app->user->can('operator')],															
					['label' => Yii::t('app', 'Log'), 'url' => ['/log/index'],
						'visible' => Yii::$app->user->can('operator')],					
					['label' => Yii::t('app', 'Incident'), 'url' => ['/incident/index'],
						'visible' => Yii::$app->user->can('operator')],					
					['label' => Yii::t('app', 'Assignation'), 'url' => ['/assignation/index'],
						'visible' => Yii::$app->user->can('operator')],					
					['label' => Yii::t('app', 'Location'), 'url' => ['/location/index'],
						'visible' => Yii::$app->user->can('operator')],
					
					//Administrator
					['label' => Yii::t('app', 'Client'), 'url' => ['/client/index'],
						'visible' => Yii::$app->user->can('administrator')],						
					['label' => Yii::t('app', 'ClientType'), 'url' => ['/client-type/index'],
						'visible' => Yii::$app->user->can('administrator')],
					['label' => Yii::t('app', 'Discipline'), 'url' => ['/discipline/index'],
						'visible' => Yii::$app->user->can('administrator')],
					['label' => Yii::t('app', 'Area'), 'url' => ['/area/index'],
						'visible' => Yii::$app->user->can('administrator')],
					['label' => Yii::t('app', 'School'), 'url' => ['/school/index'],
						'visible' => Yii::$app->user->can('administrator')],
					['label' => Yii::t('app', 'Equipment'), 'url' => ['/equipment/index'],
						'visible' => Yii::$app->user->can('administrator')],
					['label' => Yii::t('app', 'EquipmentType'), 'url' => ['/equipment-type/index'],
						'visible' => Yii::$app->user->can('administrator')],
					['label' => Yii::t('app', 'EquipmentStatus'), 'url' => ['/equipment-status/index'],
						'visible' => Yii::$app->user->can('administrator')],
					['label' => Yii::t('app', 'Room'), 'url' => ['/room/index'],
						'visible' => Yii::$app->user->can('administrator')],
					['label' => Yii::t('app', 'User'), 'url' => ['/user/index'],
						'visible' => Yii::$app->user->can('administrator')],
					['label' => Yii::t('app', 'Log'), 'url' => ['/log/index'],
						'visible' => Yii::$app->user->can('administrator')],
					['label' => Yii::t('app', 'LogType'), 'url' => ['/log-type/index'],
						'visible' => Yii::$app->user->can('administrator')],					
					['label' => Yii::t('app', 'Incident'), 'url' => ['/incident/index'],
						'visible' => Yii::$app->user->can('administrator')],					
					['label' => Yii::t('app', 'Assignation'), 'url' => ['/assignation/index'],
						'visible' => Yii::$app->user->can('administrator')],					
					['label' => Yii::t('app', 'Location'), 'url' => ['/location/index'],
						'visible' => Yii::$app->user->can('administrator')],
															
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->user_name . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
