<?php

use app\models\RiGigi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\RiGigiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ri Gigis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-gigi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ri Gigi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ri_gigi_id',
            'rm_gigi_id',
            'tanggal',
            'gigi:ntext',
            'keluhan_diagnosa:ntext',
            //'perawatan:ntext',
            //'user_id',
            //'is_verified',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RiGigi $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ri_gigi_id' => $model->ri_gigi_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
