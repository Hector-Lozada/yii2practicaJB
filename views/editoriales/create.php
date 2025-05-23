<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Editoriales $model */

$this->title = Yii::t('app', 'Create Editoriales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Editoriales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="editoriales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
