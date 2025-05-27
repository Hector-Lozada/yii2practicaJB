<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Autores $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="autores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'required' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true, 'required' => true]) ?>

    <?= $form->field($model, 'biografia')->textarea(['rows' => 6, 'required' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->input('date', ['required' => true]) ?>

    <?= $form->field($model, 'fecha_fallecimiento')->input('date', ['required' => true]) ?>

    <?= $form->field($model, 'nacionalidad')->textInput(['maxlength' => true, 'required' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

