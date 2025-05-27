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
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .navbar-brand img {
            height: 42px;
            margin-right: 10px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 2px 8px #0001;
            padding: 2px;
        }
        .navbar {
            box-shadow: 0 4px 18px -5px #0002;
        }
        body {
            background: #f5f7fa;
        }
        footer#footer {
            border-top: 1px solid #ddd;
            background: #f8f9fa;
        }
        .dropdown-menu-dark {
            background-color: #343a40;
            color: #fff;
        }
        .dropdown-menu-dark .dropdown-item {
            color: #fff;
        }
        .dropdown-menu-dark .dropdown-divider {
            border-top: 1px solid #555;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' =>
            Html::img(Yii::getAlias('@web/images/logo.png'), [
                'alt' => 'Logo UTELVT',
                'style' => 'height:42px; display:inline-block; vertical-align:middle;'
            ]) .
            '<span style="vertical-align:middle; font-weight:700; letter-spacing:1px; font-size:1.3rem; color:#fff;">UTELVT</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            [
                'label' => 'Biblioteca Virtual',
                'items' => [
                    ['label' => 'Usuarios', 'url' => ['/usuarios/index']],
                    ['label' => 'Libros', 'url' => ['/libros/index']],
                    ['label' => 'Categorías', 'url' => ['/categorias/index']],
                    ['label' => 'Préstamos', 'url' => ['/prestamos/index']],
                    ['label' => 'Editoriales', 'url' => ['/editoriales/index']],
                    ['label' => 'Autores', 'url' => ['/autores/index']],
                    '<div class="dropdown-divider"></div>',
                    ['label' => 'Todos los módulos', 'url' => '#'],
                ],
                'dropdownOptions' => [
                    'class' => 'dropdown-menu-dark'
                ]
            ],
        ]
    ]);
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Salir (' . Html::encode(Yii::$app->user->identity->email) . ')',
                        ['class' => 'nav-link btn btn-link logout', 'style' => 'color:#fff;text-decoration:none;']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main" style="padding-top:85px;">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; UTELVT <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>