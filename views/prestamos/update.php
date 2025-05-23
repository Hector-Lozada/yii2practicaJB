<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Prestamos $model */

$this->title = Yii::t('app', 'Update Prestamos: {name}', [
    'name' => $model->id_prestamo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prestamos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prestamo, 'url' => ['view', 'id_prestamo' => $model->id_prestamo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="prestamos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
