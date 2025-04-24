<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LibrosCategorias $model */

$this->title = Yii::t('app', 'Update Libros Categorias: {name}', [
    'name' => $model->idlibros_categorias,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Libros Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idlibros_categorias, 'url' => ['view', 'idlibros_categorias' => $model->idlibros_categorias]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="libros-categorias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
