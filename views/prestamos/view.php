<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Prestamos $model */

$this->title = $model->id_prestamo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prestamos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="prestamos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id_prestamo' => $model->id_prestamo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id_prestamo' => $model->id_prestamo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id_prestamo',
        [
            'label' => 'Usuario',
            'value' => function ($model) {
                return $model->usuario->nombre ?? '(no disponible)';
            },
        ],
        [
            'label' => 'Libro',
            'value' => function ($model) {
                return $model->libro->titulo ?? '(no disponible)';
            },
        ],
        [
            'attribute' => 'fecha_prestamo',
            'value' => function ($model) {
                return Yii::$app->formatter->asDate($model->fecha_prestamo);
            },
        ],
        [
            'attribute' => 'fecha_devolucion_esperada',
            'value' => function ($model) {
                return Yii::$app->formatter->asDate($model->fecha_devolucion_esperada);
            },
        ],
        [
            'attribute' => 'fecha_devolucion_real',
            'value' => function ($model) {
                return Yii::$app->formatter->asDate($model->fecha_devolucion_real);
            },
        ],
        'estado',
    ],
]) ?>


</div>
