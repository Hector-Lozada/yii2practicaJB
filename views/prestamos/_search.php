<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PrestamosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="prestamos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_prestamo') ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'id_libro') ?>

    <?= $form->field($model, 'fecha_prestamo') ?>

    <?= $form->field($model, 'fecha_devolucion_esperada') ?>

    <?php // echo $form->field($model, 'fecha_devolucion_real') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
