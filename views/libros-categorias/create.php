<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LibrosCategorias $model */

$this->title = Yii::t('app', 'Create Libros Categorias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Libros Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libros-categorias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
