<?php

use app\models\Autores;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\AutoresSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Autores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Autores'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_autor',
            'nombre',
            'apellido',
            'biografia:ntext',
            'fecha_nacimiento',
            //'fecha_fallecimiento',
            //'nacionalidad',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Autores $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_autor' => $model->id_autor]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
