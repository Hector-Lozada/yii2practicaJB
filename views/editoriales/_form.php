<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Editoriales $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="editoriales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput([
        'maxlength' => true,
        'placeholder' => 'Ingrese el nombre de la editorial',
        'required' => true
    ])->label('Nombre *') ?>

    <?= $form->field($model, 'pais')->textInput([
        'maxlength' => true,
        'placeholder' => 'Ingrese el país de origen',
        'required' => true
    ])->label('País *') ?>

    <?= $form->field($model, 'fundacion')->textInput([
        'type' => 'number',
        'min' => 1000,
        'max' => (int)date('Y'),
        'placeholder' => 'Ingrese el año de fundación',
        'required' => true
    ])->label('Año de fundación *') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
