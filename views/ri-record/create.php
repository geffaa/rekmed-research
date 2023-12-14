<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RiRecord $model */

$this->title = 'Create Ri Record';
$this->params['breadcrumbs'][] = ['label' => 'Ri Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
