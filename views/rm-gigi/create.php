<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RmGigi $model */

$this->title = 'Create Rm Gigi';
$this->params['breadcrumbs'][] = ['label' => 'Rm Gigis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-gigi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
