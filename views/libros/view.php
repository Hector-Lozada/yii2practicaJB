<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Autores;
use app\models\Categorias;
use app\models\Editoriales;

/** @var yii\web\View $this */
/** @var app\models\Libros $model */

$this->title = $model->titulo; // Cambiado para mostrar el título en lugar del ID
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Libros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="libros-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id_libro' => $model->id_libro], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id_libro' => $model->id_libro], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_libro',
            'titulo',
            [
                'attribute' => 'id_autor',
                'value' => function($model) {
                    $autor = Autores::findOne($model->id_autor);
                    return $autor ? $autor->nombre : 'No especificado';
                }
            ],
            [
                'attribute' => 'id_categoria',
                'value' => function($model) {
                    $categoria = Categorias::findOne($model->id_categoria);
                    return $categoria ? $categoria->nombre : 'No especificado';
                }
            ],
            [
                'attribute' => 'id_editorial',
                'value' => function($model) {
                    if ($model->id_editorial) {
                        $editorial = Editoriales::findOne($model->id_editorial);
                        return $editorial ? $editorial->nombre : 'No especificado';
                    }
                    return 'No especificado';
                }
            ],
            'isbn',
            'anio_publicacion',
            'paginas',
            'sinopsis:ntext',
            [
                'attribute' => 'portada',
                'format' => 'html',
                'value' => function($model) {
                    if ($model->portada) {
                        return Html::img('@web/uploads/portadas/' . $model->portada, [
                            'class' => 'img-thumbnail',
                            'style' => 'max-width: 200px;'
                        ]);
                    }
                    return 'No disponible';
                }
            ],
            [
                'attribute' => 'archivo_pdf',
                'format' => 'html',
                'value' => function($model) {
                    if ($model->archivo_pdf) {
                        return Html::a('Descargar PDF', '@web/uploads/pdfs/' . $model->archivo_pdf, [
                            'class' => 'btn btn-primary',
                            'target' => '_blank'
                        ]);
                    }
                    return 'No disponible';
                }
            ],
            [
                'attribute' => 'fecha_agregado',
                'value' => function($model) {
                    return Yii::$app->formatter->asDate($model->fecha_agregado, 'php:Y-m-d');
                }
            ],
            [
                'attribute' => 'disponible',
                'value' => function($model) {
                    return $model->disponible ? 'Disponible' : 'No disponible';
                }
            ],
        ],
    ]) ?>

</div>