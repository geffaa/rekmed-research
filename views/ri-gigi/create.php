<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RiGigi $model */

$this->title = 'Pemeriksaan';
$this->params['breadcrumbs'][] = ['label' => 'Poli Gigi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-gigi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
