<?php

use app\models\Usuarios;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\UsuariosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Usuarios'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_usuario',
            'nombre',
            'apellido',
            'email:email',
            'contrasena',

            // Imagen con etiqueta <img>
            [
                'attribute' => 'imagen_perfil',
                'format' => 'html',
    'value' => function($model) {
        // Verifica si hay una imagen
        if ($model->imagen_perfil) {
            // Genera la URL correcta (ajusta según tu estructura)
            $rutaImagen = Url::to('@web/uploads/images/' . basename($model->imagen_perfil));
            
            // Muestra la imagen con un estilo y texto alternativo
            return Html::img(
                $rutaImagen,
                [
                    'style' => 'width: 80px; height: auto; ',
                    'alt' => 'Foto de ' . $model->nombre,
                ]
            );
        }
        // Si no hay imagen, muestra un placeholder o texto
        return Html::img(
            'https://via.placeholder.com/50',
            ['style' => 'width: 50px; height: auto;', 'alt' => 'Sin imagen']
        );
    },
],

            'fecha_registro',

            'rol',

            // Estado como texto legible
            [
                'attribute' => 'estado',
                'value' => function ($model) {
                    return $model->estado == 1 ? 'Activo' : 'Inactivo';
                },
                'filter' => [
                    1 => 'Activo',
                    0 => 'Inactivo',
                ],
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Usuarios $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_usuario' => $model->id_usuario]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
