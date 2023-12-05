<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\RiGigi $model */

$this->title = $model->ri_gigi_id;
$this->params['breadcrumbs'][] = ['label' => 'Ri Gigis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ri-gigi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ri_gigi_id' => $model->ri_gigi_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ri_gigi_id' => $model->ri_gigi_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ri_gigi_id',
            'rm_gigi_id',
            'tanggal',
            'gigi:ntext',
            'keluhan_diagnosa:ntext',
            'perawatan:ntext',
            'user_id',
            'is_verified',
        ],
    ]) ?>

</div>
