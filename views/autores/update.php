<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Autores $model */

$this->title = Yii::t('app', 'Update Autores: {name}', [
    'name' => $model->id_autor,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Autores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_autor, 'url' => ['view', 'id_autor' => $model->id_autor]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="autores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
