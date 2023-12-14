<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RiRecord $model */

$this->title = 'Update Ri Record: ' . $model->ri_record_id;
$this->params['breadcrumbs'][] = ['label' => 'Ri Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ri_record_id, 'url' => ['view', 'ri_record_id' => $model->ri_record_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ri-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
