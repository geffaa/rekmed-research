<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\RiRecord $model */

$this->title = $model->ri_record_id;
$this->params['breadcrumbs'][] = ['label' => 'Ri Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ri-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ri_record_id' => $model->ri_record_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ri_record_id' => $model->ri_record_id], [
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
            'ri_record_id',
            'rawat_inap_id',
            'tanggal',
            'subjective:ntext',
            'objective:ntext',
            'assessment:ntext',
            'plan:ntext',
            'is_verified',
            'is_removed',
            'user_id',
        ],
    ]) ?>

</div>
