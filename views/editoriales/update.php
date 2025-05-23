<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Editoriales $model */

$this->title = Yii::t('app', 'Update Editoriales: {name}', [
    'name' => $model->id_editorial,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Editoriales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_editorial, 'url' => ['view', 'id_editorial' => $model->id_editorial]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="editoriales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
