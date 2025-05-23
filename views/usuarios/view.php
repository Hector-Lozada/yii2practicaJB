<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */

$this->title = $model->id_usuario;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id_usuario' => $model->id_usuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id_usuario' => $model->id_usuario], [
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
            'id_usuario',
            'nombre',
            'apellido',
            'email:email',
            'contrasena',
            [
                'attribute' => 'imagen_perfil',
            'format' => 'html',
                'value' => function($model) {
                    if ($model->imagen_perfil) {
                        return Html::img($model->imagen_perfil, [
                            'style' => 'max-width: 300px; max-height: 300px;',
                            'class' => 'img-thumbnail',
                            'alt' => 'Immagen',
                        ]);
                    }
                    return 'No hay imagen';
                },
            ],
            'fecha_registro',
            'rol',
             [
                'attribute' => 'estado',
                'value' => function ($model) {
                    return $model->estado == 1 ? 'Activo' : 'Inactivo';
                },
                'filter' => [
                    1 => 'Activo',
                    0 => 'Inactivo',
                ],
            ],
        ],
    ]) ?>

</div>
