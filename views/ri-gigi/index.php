<?php

use app\models\RiGigi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\EncryptionHelper;
/** @var yii\web\View $this */
/** @var app\models\RiGigiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="ri-gigi-index">



    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'text-align:center;'],
                'headerOptions' => ['style' => 'text-align:center;'],
            ],
            [
                'attribute' => 'tanggal',
                'format' => ['date', 'php:d-F-Y'],
                'headerOptions' => ['style' => 'text-align:center;'],
            ],
            [
                'attribute' => 'gigi',
                'format' => 'ntext',
                'headerOptions' => ['style' => 'text-align:center;'],
            ],
            [
                'attribute' => 'keluhan_diagnosa',
                'format' => 'ntext',
                'headerOptions' => ['style' => 'text-align:center;'],
            ],
            [
                'attribute' => 'perawatan',
                'format' => 'ntext',
                'headerOptions' => ['style' => 'text-align:center;'],
            ],
            [
                'label' => 'Paraf',
                'attribute' => 'is_verified',
                'value' => function ($model) {
                    if ($model->is_verified == 1) {
                        return 'Verified';
                    } else {
                        return Html::a('Verifikasi', ['REPLACE-WITH-ACTION'], ['class' => 'btn btn-circle default']);
                    }
                },
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 15%; text-align:center;'],
                'headerOptions' => ['style' => 'text-align:center;'],
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 15%; text-align:center;'],     
                'value' => function ($model) {
                    $buttons = Html::a('Edit', ['edit', 'id' => $model['ri_gigi_id']], [
                                    'class' => 'btn btn-circle green-haze',
                                    'onclick' => 'editRecordGigi(' . $model['ri_gigi_id'] . '); return false;',
                                    ]) 
                                . ' ' .
                               Html::a('Delete', ['delete', 'id' => $model['ri_gigi_id']], [
                                   'class' => 'btn btn-circle red',
                                   'data-confirm' => 'Are you sure you want to delete this item?',
                                   'data-method' => 'post',
                                   'onclick' => 'deleteRecordGigi(' . $model['ri_gigi_id'] . '); return false;',
                               ]);  
    
                    return $buttons;
                },
            ],
        ],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['style' => 'background-color: #ffffff;'];
        },
    ]); ?>

    <p class="text-right">
        <?= Html::a('<span class="fa fa-plus"></span> Tambah Data', ['create'], ['class' => 'btn btn-circle green-haze']) ?>
    </p>

    <?php Pjax::end(); ?>

</div>
