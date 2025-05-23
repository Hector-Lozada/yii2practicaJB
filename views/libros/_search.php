<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LibrosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="libros-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_libro') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'id_autor') ?>

    <?= $form->field($model, 'id_categoria') ?>

    <?= $form->field($model, 'id_editorial') ?>

    <?php // echo $form->field($model, 'isbn') ?>

    <?php // echo $form->field($model, 'anio_publicacion') ?>

    <?php // echo $form->field($model, 'paginas') ?>

    <?php // echo $form->field($model, 'sinopsis') ?>

    <?php // echo $form->field($model, 'portada') ?>

    <?php // echo $form->field($model, 'archivo_pdf') ?>

    <?php // echo $form->field($model, 'fecha_agregado') ?>

    <?php // echo $form->field($model, 'disponible') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
