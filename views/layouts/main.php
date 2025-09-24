<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <div class="all-posts">
        <?php $this->beginBody() ?>

        <header id="header">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="btns">
                <?php if (Yii::$app->user->isGuest): ?>
                    <?= Html::a('Login', ['site/login'], ['class' => 'cbtn']) ?>
                <?php else: ?>
                    <?php if (Yii::$app->controller->id === 'post' && Yii::$app->controller->action->id === 'my'): ?>
                        <?= Html::a('All posts', ['/'], ['class' => 'cbtn gray']) ?>
                    <?php else: ?>
                        <?= Html::a('My posts', ['post/my'], ['class' => 'cbtn gray']) ?>
                    <?php endif; ?>
                    <?= Html::a('Logout ', ['site/logout'], [
                        'class' => 'cbtn',
                        'data' => ['method' => 'post'],
                    ]) ?>
                <?php endif; ?>
            </div>
        </header>

        <main>
            <?= Alert::widget() ?>
            <?= $content ?>
        </main>

        <?php $this->endBody() ?>
    </div>
</body>

</html>
<?php $this->endPage() ?>