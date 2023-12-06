<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RmGigi $model */

$this->title = 'Update Rekam Medis Gigi';
$this->params['breadcrumbs'][] = ['label' => 'Rekam Medis Gigi', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rm-gigi-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
