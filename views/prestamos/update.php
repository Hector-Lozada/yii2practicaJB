<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Prestamos $model */

$this->title = Yii::t('app', 'Update Prestamos: {name}', [
    'name' => $model->idprestamos,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prestamos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idprestamos, 'url' => ['view', 'idprestamos' => $model->idprestamos]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="prestamos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
