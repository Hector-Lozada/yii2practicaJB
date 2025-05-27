<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuarios;
use app\models\Libros;

/** @var yii\web\View $this */
/** @var app\models\Prestamos $model */
/** @var yii\widgets\ActiveForm $form */

// Listas para los dropdowns
$usuarios = ArrayHelper::map(Usuarios::find()->all(), 'id_usuario', 'nombre');
$libros = ArrayHelper::map(Libros::find()->all(), 'id_libro', 'titulo');

?>

<div class="prestamos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_usuario')->dropDownList(
        $usuarios,
        ['prompt' => 'Seleccione un usuario',
        'required' => true,]
    )->label('Usuario *') ?>

    <?= $form->field($model, 'id_libro')->dropDownList(
        $libros,
        ['prompt' => 'Seleccione un libro',
        'required' => true,]
    )->label('Libro *') ?>

    <?= $form->field($model, 'fecha_devolucion_esperada')->textInput([
        'type' => 'date',
        'placeholder' => 'Seleccione la fecha esperada de devolución',
        'required' => true,
    ])->label('Fecha de devolución esperada *') ?>

    <?= $form->field($model, 'fecha_devolucion_real')->textInput([
        'type' => 'date',
        'placeholder' => 'Seleccione la fecha real de devolución',
        'required' => true,
    ])->label('Fecha de devolución real *') ?>

    <?= $form->field($model, 'estado')->dropDownList(
        [
            'activo' => 'Activo',
            'completado' => 'Completado',
            'atrasado' => 'Atrasado',
        ],
        ['prompt' => 'Seleccione un estado',
        'required' => true,]
    )->label('Estado *') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
