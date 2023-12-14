<?php

use app\models\RawatInap;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\EncryptionHelper;
/** @var yii\web\View $this */
/** @var app\models\RawatInapSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Rawat Inap';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rawat-inap-index">

    <p>
        <?= Html::a('Create Rawat Inap', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rawat_inap_id',
            'mr',
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, RawatInap $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'rawat_inap_id' => $model->rawat_inap_id]);
            //      }
            // ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view} {delete} ',
                'contentOptions' => ['style' => 'width: 10%;'],     
                'buttons' => [
                    'update' => function($url,$model) {
                        $id = EncryptionHelper::encrypt($model->rawat_inap_id);
                        return Html::a('<span class="btn btn-default fa fa-pencil"></span>', Url::to(['rawat-inap/update','rawat_inap_id'=>$id]), [
                            'title' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ]);
                    },
                    // 'view' => function($url,$model) {
                    //     $id = EncryptionHelper::encrypt($model->rawat_inap_id);
                    //     return Html::a('<span class="btn btn-default fa fa-eye"></span>', Url::to(['rawat-inap/view','rawat_inap_id'=>$id]), [
                    //         'title' => Yii::t('yii', 'Lihat'),
                    //         'data-pjax' => '0',
                    //     ]); 
                    // },
                    // 'delete' => function($url,$model) {
                    //     $id = EncryptionHelper::encrypt($model->rawat_inap_id);
                    //     return Html::a('<i class="fa fa-trash-o"></i>', Url::to(['rawat-inap/delete','rawat_inap_id'=>$id]), [
                    //             'title' => Yii::t('yii', 'Hapus'),
                    //             'class'=> 'btn btn-default',
                    //             'data-confirm' => Yii::t('yii', 'Apakah Anda Yakin akan menghapus Rekam Medis ini?'),
                    //             'data-method' => 'post',
                    //         ]);
                    // },
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
