<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LibrosCategorias $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="libros-categorias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'libro_id')->textInput() ?>

    <?= $form->field($model, 'categoria_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
