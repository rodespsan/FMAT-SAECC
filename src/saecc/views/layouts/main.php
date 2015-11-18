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
					['label' => 'Client', 'url' => ['/client/index']],
					['label' => 'ClientType', 'url' => ['/client-type/index']],
					['label' => 'Discipline', 'url' => ['/discipline/index']],
					['label' => 'Area', 'url' => ['/area/index']],
					['label' => 'School', 'url' => ['/school/index']],
					['label' => 'Equipment', 'url' => ['/equipment/index']],
					['label' => 'EquipmentType', 'url' => ['/equipment-type/index']],
					['label' => 'Status', 'url' => ['/status/index']],
					['label' => 'Room', 'url' => ['/room/index']],
					['label' => 'User', 'url' => ['/user/index']],
					['label' => 'Log', 'url' => ['/log/index']],
					['label' => 'LogType', 'url' => ['/log-type/index']],
					['label' => 'Incident', 'url' => ['/incident/index']],
					['label' => 'Assignation', 'url' => ['/assignation/index']],
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
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
