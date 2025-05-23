<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'nombre')->textInput([
                'maxlength' => true,
                'required' => true,
                'placeholder' => 'Ingrese el nombre'
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'apellido')->textInput([
                'maxlength' => true,
                'required' => true,
                'placeholder' => 'Ingrese el apellido'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput([
                'maxlength' => true,
                'type' => 'email',
                'required' => true,
                'placeholder' => 'ejemplo@correo.com'
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'contrasena')->passwordInput([
                'maxlength' => true,
                'required' => true,
                'placeholder' => 'Cree una contraseña'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'imageFile')->fileInput([
                    'required' => $model->isNewRecord,
                    'accept' => 'image/png, image/jpeg, image/jpg, image/gif',
                    'class' => 'form-control-file'
                ])->label('Foto del usuario ' . ($model->isNewRecord ? '<span class="text-danger">*</span>' : '')) ?>
                <small class="form-text text-muted">Formatos: PNG, JPG, JPEG, GIF (Max. 5MB)</small>
            </div>
        </div>

        <div class="col-md-6">
            <?php if (!$model->isNewRecord && $model->imagen_perfil): ?>
                <div class="form-group">
                    <label class="control-label">Imagen Actual</label>
                    <div>
                        <?= Html::img(Yii::getAlias('@web') . '/uploads/images/' . $model->imagen_perfil, [
    'alt' => 'Imagen del usuario',
    'class' => 'img-thumbnail',
    'style' => 'max-width: 150px; max-height: 150px;'
]) ?>

                        <small class="form-text text-muted">Dejar en blanco para mantener la imagen actual</small>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

        <div class="col-md-6">
            <?= $form->field($model, 'fecha_registro')->input('date', [
                'required' => true,
                'class' => 'form-control',
                'value' => $model->isNewRecord ? date('Y-m-d') : Yii::$app->formatter->asDate($model->fecha_registro, 'yyyy-MM-dd')
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'rol')->dropDownList([
                'admin' => 'Administrador', 
                'usuario' => 'Usuario'
            ], [
                'required' => true,
                'prompt' => 'Seleccione un rol'
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'estado')->dropDownList([
                1 => 'Activo',
                0 => 'Inactivo'
            ], [
                'required' => true,
                'prompt' => 'Seleccione estado'
            ]) ?>
        </div>
    </div>

    <div class="form-group text-right mt-4">
        <?= Html::a('Cancelar', ['index'], [
            'class' => 'btn btn-outline-secondary mr-2',
            'style' => 'min-width: 100px;'
        ]) ?>
        <?= Html::submitButton('Guardar Usuario', [
            'class' => 'btn btn-primary',
            'style' => 'min-width: 150px;'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>