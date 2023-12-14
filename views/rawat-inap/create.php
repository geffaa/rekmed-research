<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RawatInap $model */

$this->title = 'Create Rawat Inap';
$this->params['breadcrumbs'][] = ['label' => 'Rawat Inaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rawat-inap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
