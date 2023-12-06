<?php

use app\models\RmGigi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\EncryptionHelper;

/** @var yii\web\View $this */
/** @var app\models\RmGigiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Rawat Inap Gigi';
$this->params['breadcrumbs'][] = 'Rekam Medis Gigi';
?>
<div class="rm-gigi-index">

    <p>
        <?= Html::a('Create Rm Gigi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width: 3%;'],
            ],
            [
                'attribute' => 'rm_id',
                'value' => 'rm_id',
                'contentOptions' => ['style' => 'width: 20%;'],
            ],
            [
                'attribute' => 'Nama Pasien',
                'value' => 'rm.mr0.nama',
                'contentOptions' => ['style' => 'width: 30%;'],     
            ],
            // 'rm_gigi_id',
            // 'rm_id',
            // 'oklusi:ntext',
            // 'torus_palatinus:ntext',
            // 'torus_mandibularis:ntext',
            //'palatum:ntext',
            //'supernumerary_teeth:ntext',
            //'diastema:ntext',
            //'gigi_anomali:ntext',
            //'lain_lain:ntext',
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, RmGigi $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'rm_gigi_id' => $model->rm_gigi_id]);
            //      },
            //     'contentOptions' => ['style' => 'width: 20%;'],     
            // ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view} {delete} ',
                'contentOptions' => ['style' => 'width: 10%;'],     
                'buttons' => [
                    'update' => function($url,$model) {
                        $id = EncryptionHelper::encrypt($model->rm_gigi_id);
                        return Html::a('<span class="btn btn-default fa fa-pencil"></span>', Url::to(['rm-gigi/update','rm_gigi_id'=>$id]), [
                            'title' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'view' => function($url,$model) {
                        $id = EncryptionHelper::encrypt($model->rm_gigi_id);
                        return Html::a('<span class="btn btn-default fa fa-eye"></span>', Url::to(['rm-gigi/view','rm_gigi_id'=>$id]), [
                            'title' => Yii::t('yii', 'Lihat'),
                            'data-pjax' => '0',
                        ]); 
                    },
                    'delete' => function($url,$model) {
                        $id = EncryptionHelper::encrypt($model->rm_gigi_id);
                        return Html::a('<i class="fa fa-trash-o"></i>', Url::to(['rm-gigi/delete','rm_gigi_id'=>$id]), [
                                'title' => Yii::t('yii', 'Hapus'),
                                'class'=> 'btn btn-default',
                                'data-confirm' => Yii::t('yii', 'Apakah Anda Yakin akan menghapus Rekam Medis ini?'),
                                'data-method' => 'post',
                            ]);
                    },
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>