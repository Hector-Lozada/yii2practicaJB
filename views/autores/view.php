<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Autores $model */

$this->title = $model->id_autor;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Autores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="autores-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id_autor' => $model->id_autor], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id_autor' => $model->id_autor], [
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
            'id_autor',
            'nombre',
            'apellido',
            'biografia:ntext',
            'fecha_nacimiento',
            'fecha_fallecimiento',
            'nacionalidad',
        ],
    ]) ?>

</div>
