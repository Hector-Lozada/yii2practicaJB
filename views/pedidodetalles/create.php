<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PedidoDetalles $model */

$this->title = Yii::t('app', 'Create Pedido Detalles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedido Detalles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-detalles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
