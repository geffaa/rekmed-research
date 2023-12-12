<?php

use app\models\Odontogram;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OdontogramSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Odontograms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odontogram-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Odontogram', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rm_gigi_id',
            'gigi_id',
            'status_gigi_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Odontogram $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'rm_gigi_id' => $model->rm_gigi_id, 'gigi_id' => $model->gigi_id]);
                 }
            ],
        ],
    ]); ?>


</div>
