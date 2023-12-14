<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RawatInap $model */

$this->title = 'Update Rawat Inap';
$this->params['breadcrumbs'][] = ['label' => 'Rawat Inap', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rawat-inap-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
