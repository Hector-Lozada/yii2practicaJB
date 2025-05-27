<?php

use app\models\Libros;
use app\models\Autores;
use app\models\Categorias;
use app\models\Editoriales;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\LibrosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Libros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libros-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Libros'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_libro', // Puedes comentar esta línea si no quieres mostrar el ID
            'titulo',
            [
                'attribute' => 'id_autor',
                'value' => function($model) {
                    $autor = Autores::findOne($model->id_autor);
                    return $autor ? $autor->nombre : 'No especificado';
                },
                'filter' => ArrayHelper::map(Autores::find()->all(), 'id_autor', 'nombre')
            ],
            [
                'attribute' => 'id_categoria',
                'value' => function($model) {
                    $categoria = Categorias::findOne($model->id_categoria);
                    return $categoria ? $categoria->nombre : 'No especificado';
                },
                'filter' => ArrayHelper::map(Categorias::find()->all(), 'id_categoria', 'nombre')
            ],
            [
                'attribute' => 'id_editorial',
                'value' => function($model) {
                    if ($model->id_editorial) {
                        $editorial = Editoriales::findOne($model->id_editorial);
                        return $editorial ? $editorial->nombre : 'No especificado';
                    }
                    return 'No especificado';
                },
                'filter' => ArrayHelper::map(Editoriales::find()->all(), 'id_editorial', 'nombre')
            ],
            'isbn',
            'anio_publicacion',
            'paginas',
            [
                'attribute' => 'sinopsis',
                'value' => function($model) {
                    return substr($model->sinopsis, 0, 50) . (strlen($model->sinopsis) > 50 ? '...' : '');
                }
            ],
            [
                'attribute' => 'portada',
                'format' => 'html',
                'value' => function($model) {
                    if ($model->portada) {
                        return Html::img('@web/uploads/portadas/' . $model->portada, [
                            'class' => 'img-thumbnail',
                            'style' => 'max-width: 50px;'
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
                        return Html::a('PDF', '@web/uploads/pdfs/' . $model->archivo_pdf, [
                            'class' => 'btn btn-xs btn-primary',
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
                },
                'filter' => false
            ],
            [
                'attribute' => 'disponible',
                'value' => function($model) {
                    return $model->disponible ? 'Sí' : 'No';
                },
                'filter' => [1 => 'Sí', 0 => 'No']
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Libros $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_libro' => $model->id_libro]);
                },
                'contentOptions' => ['style' => 'width: 120px;'],
                'template' => '{view} {update} {delete}'
            ],
        ],
        'pager' => [
            'options' => ['class' => 'pagination pagination-sm'],
            'maxButtonCount' => 5,
        ],
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
    ]); ?>

    <?php Pjax::end(); ?>

</div>