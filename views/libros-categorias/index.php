<?php

use app\models\LibrosCategorias;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\LibrosCategoriasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Libros Categorias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libros-categorias-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Libros Categorias'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idlibros_categorias',
            'libro_id',
            'categoria_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, LibrosCategorias $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idlibros_categorias' => $model->idlibros_categorias]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
