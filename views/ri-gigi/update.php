<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RiGigi $model */

$this->title = 'Update Ri Gigi: ' . $model->ri_gigi_id;
$this->params['breadcrumbs'][] = ['label' => 'Ri Gigis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ri_gigi_id, 'url' => ['view', 'ri_gigi_id' => $model->ri_gigi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ri-gigi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
