<?php

use app\models\RiRecord;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\RiRecordSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ri Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ri-record-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ri Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ri_record_id',
            'rawat_inap_id',
            'tanggal',
            'subjective:ntext',
            'objective:ntext',
            //'assessment:ntext',
            //'plan:ntext',
            //'is_verified',
            //'is_removed',
            //'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RiRecord $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ri_record_id' => $model->ri_record_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
