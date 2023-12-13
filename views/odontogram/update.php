<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Odontogram $model */

$this->title = 'Update Odontogram: ' . $model->odontogram_id;
$this->params['breadcrumbs'][] = ['label' => 'Odontograms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->odontogram_id, 'url' => ['view', 'odontogram_id' => $model->odontogram_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="odontogram-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
