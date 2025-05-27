<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Autores;
use app\models\Categorias;
use app\models\Editoriales;

/** @var yii\web\View $this */
/** @var app\models\Libros $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="libros-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true, 'required' => true]) ?>
        </div>
        
        <div class="col-md-6">
            <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?= $form->field($model, 'id_autor')->dropDownList(
                    ArrayHelper::map(Autores::find()->all(), 'id_autor', 'nombre'),
                    ['prompt' => 'Seleccione un autor', 'required' => true, 'class' => 'form-control']
                ) ?>
                <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar Autor', 
                    ['autores/create'], 
                    [
                        'class' => 'btn btn-sm btn-success mt-2',
                        'target' => '_blank'
                    ]) ?>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <?= $form->field($model, 'id_categoria')->dropDownList(
                    ArrayHelper::map(Categorias::find()->all(), 'id_categoria', 'nombre'),
                    ['prompt' => 'Seleccione una categoría', 'required' => true, 'class' => 'form-control']
                ) ?>
                <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar Categoría', 
                    ['categorias/create'], 
                    [
                        'class' => 'btn btn-sm btn-success mt-2',
                        'target' => '_blank'
                    ]) ?>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <?= $form->field($model, 'id_editorial')->dropDownList(
                    ArrayHelper::map(Editoriales::find()->all(), 'id_editorial', 'nombre'),
                    ['prompt' => 'Seleccione una editorial', 'class' => 'form-control',
                    'required' => true]
                ) ?>
                <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar Editorial', 
                    ['editoriales/create'], 
                    [
                        'class' => 'btn btn-sm btn-success mt-2',
                        'target' => '_blank'
                    ]) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'anio_publicacion')->textInput([
                'type' => 'number',
                'min' => 1000,
                'max' => date('Y'),
                'required' => true
            ]) ?>
        </div>
        
        <div class="col-md-3">
            <?= $form->field($model, 'paginas')->textInput(['type' => 'number', 'min' => 1,'required' => true]) ?>
        </div>
        
        <div class="col-md-3">
            <?= $form->field($model, 'fecha_agregado')->input('date', [
                'value' => $model->isNewRecord ? date('Y-m-d') : Yii::$app->formatter->asDate($model->fecha_agregado, 'yyyy-MM-dd'),'required' => true
            ]) ?>
        </div>
        
        <div class="col-md-3">
            <?= $form->field($model, 'disponible')->dropDownList([
                1 => 'Disponible',
                0 => 'No disponible',
                'required' => true,
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'portadaFile')->fileInput(['required' => true]) ?>
            <?php if (!$model->isNewRecord && $model->portada): ?>
                <div class="current-file">
                    <label>Portada actual:</label>
                    <?= Html::img('@web/uploads/portadas/' . $model->portada, [
                        'class' => 'img-thumbnail',
                        'style' => 'max-width: 200px; display: block;'
                    ]) ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="col-md-6">
            <?= $form->field($model, 'pdfFile')->fileInput(['required' => true]) ?>
            <?php if (!$model->isNewRecord && $model->archivo_pdf): ?>
                <div class="current-file">
                    <label>PDF actual:</label>
                    <?= Html::a($model->archivo_pdf, '@web/uploads/pdfs/' . $model->archivo_pdf, [
                        'target' => '_blank',
                        'class' => 'btn btn-info'
                    ]) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?= $form->field($model, 'sinopsis')->textarea(['rows' => 6,'required' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
// Script para recargar la página después de cerrar la ventana emergente
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[target="_blank"]');
    
    links.forEach(link => {
        link.addEventListener('click', function() {
            const interval = setInterval(() => {
                if (link.closest('form')) {
                    const form = link.closest('form');
                    const formData = new FormData(form);
                    
                    fetch(window.location.href, {
                        method: 'POST',
                        body: formData
                    }).then(response => {
                        if (response.ok) {
                            window.location.reload();
                        }
                    });
                }
            }, 1000);
            
            window.addEventListener('focus', function handler() {
                clearInterval(interval);
                window.removeEventListener('focus', handler);
                window.location.reload();
            });
        });
    });
});
</script>