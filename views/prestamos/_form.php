<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Prestamos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="prestamos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <?= $form->field($model, 'id_libro')->textInput() ?>

    <?= $form->field($model, 'fecha_prestamo')->textInput() ?>

    <?= $form->field($model, 'fecha_devolucion_esperada')->textInput() ?>

    <?= $form->field($model, 'fecha_devolucion_real')->textInput() ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'activo' => 'Activo', 'completado' => 'Completado', 'atrasado' => 'Atrasado', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
