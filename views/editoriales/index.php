<?php

use app\models\Editoriales;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\EditorialesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Editoriales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="editoriales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Editoriales'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_editorial',
            'nombre',
            'pais',
            'fundacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Editoriales $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_editorial' => $model->id_editorial]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
