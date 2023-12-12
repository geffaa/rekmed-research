<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Odontogram $model */

$this->title = $model->rm_gigi_id;
$this->params['breadcrumbs'][] = ['label' => 'Odontograms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="odontogram-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'rm_gigi_id' => $model->rm_gigi_id, 'gigi_id' => $model->gigi_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'rm_gigi_id' => $model->rm_gigi_id, 'gigi_id' => $model->gigi_id], [
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
            'gigi_id',
            'status_gigi_id',
        ],
    ]) ?>

</div>
