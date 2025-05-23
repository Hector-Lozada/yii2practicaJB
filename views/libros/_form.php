<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Libros $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="libros-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_autor')->textInput() ?>

    <?= $form->field($model, 'id_categoria')->textInput() ?>

    <?= $form->field($model, 'id_editorial')->textInput() ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anio_publicacion')->textInput() ?>

    <?= $form->field($model, 'paginas')->textInput() ?>

    <?= $form->field($model, 'sinopsis')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'portada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'archivo_pdf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_agregado')->textInput() ?>

    <?= $form->field($model, 'disponible')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
