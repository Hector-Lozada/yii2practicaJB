<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Iniciar sesión';
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Por favor, complete los siguientes campos para ingresar:</p>

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'email')->input('email')->label('Correo electrónico') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>

        <?= $form->field($model, 'rememberMe')->checkbox()->label('Recuérdame') ?>

        <div class="form-group mt-3">
            <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>