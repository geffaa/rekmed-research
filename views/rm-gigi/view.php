<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\RmGigi $model */

$this->title = 'Rekam Medis Gigi';
$this->params['breadcrumbs'][] = ['label' => 'Rekam Medis Gigi', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View';
\yii\web\YiiAsset::register($this);
?>
<div class="rm-gigi-view">

    <p>
        <?= Html::a('Update', ['update', 'rm_gigi_id' => $model->rm_gigi_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'rm_gigi_id' => $model->rm_gigi_id], [
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
            'rm_gigi_id',
            'rm_id',
            'oklusi:ntext',
            'torus_palatinus:ntext',
            'torus_mandibularis:ntext',
            'palatum:ntext',
            'supernumerary_teeth:ntext',
            'diastema:ntext',
            'gigi_anomali:ntext',
            'lain_lain:ntext',
        ],
    ]) ?>

</div>
