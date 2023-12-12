<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Odontogram $model */

$this->title = 'Update Odontogram: ' . $model->rm_gigi_id;
$this->params['breadcrumbs'][] = ['label' => 'Odontograms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rm_gigi_id, 'url' => ['view', 'rm_gigi_id' => $model->rm_gigi_id, 'gigi_id' => $model->gigi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="odontogram-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
