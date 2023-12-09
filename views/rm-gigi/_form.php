<?php

use app\components\EncryptionHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pasien;
use yii\grid\GridView;
use app\models\RiGigi;
use yii\helpers\Url;

$pasien = new Pasien();

/** @var yii\web\View $this */
/** @var app\models\RmGigi $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php
$js = <<<JS
    $('#btn-tambah-data, #btn-batal').on('click', function() {
        $('#new-row').toggle();
        $('#btn-tambah-data').toggle();
    });
    $('#btn-simpan').on('click', function() {
        $('#new-ri').submit();
    });

    // Hide new rawat inap gigi row on page load
    $('#new-row').toggle();
JS;
$this->registerJs($js, yii\web\View::POS_READY);

$rm_gigi_id = $model->rm_gigi_id;
?>


<div class="rm-gigi-form">

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Data Pasien</span>
                </div>
            </div>
            <div class="portlet-body form">
                <table class="table table-bordered" style="width: 50%">
                    <tr>
                        <td>No. Rekam Medis</td>
                        <td><?= Html::encode($model->rm->mr0->mr) ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>
                            <?php
                            $nama = $model->rm->mr0->nama;
                            if ($nama !== null) {
                                echo $nama;
                            } else {
                                echo '<span class="text-danger" style="font-style: italic;">(not set)</span>';                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>
                            <?php
                            $alamat = $model->rm->mr0->alamat;
                            if ($alamat !== null) {
                                echo $alamat;
                            } else {
                                echo '<span class="text-danger" style="font-style: italic;">(not set)</span>';                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>
                            <?php
                            $jk = $model->rm->mr0->jk;
                            if ($jk !== null) {
                                echo $jk;
                            } else {
                                echo '<span class="text-danger" style="font-style: italic;">(not set)</span>';                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>
                            <?php
                            $umur = $pasien->getAge($model->rm->mr0->tanggal_lahir);
                            if ($umur !== null) {
                                echo $umur . ' Tahun';
                            } else {
                                echo '<span class="text-danger" style="font-style: italic;">(not set)</span>';                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Data Medik</span>
                </div>
            </div>
            <div class="portlet-body form">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-3"><?= $form->field($model, 'oklusi')->textInput(['class'=>'form-control','maxlength' => true])->hint('Normal bite/cross bite/deep bite') ?></div>
                    <div class="col-md-3"><?= $form->field($model, 'torus_palatinus')->textInput(['class'=>'form-control','maxlength' => true])->hint('Tidak ada/kecil/sedang/besar/multiple') ?></div>
                    <div class="col-md-3"><?= $form->field($model, 'torus_mandibularis')->textInput(['class'=>'form-control','maxlength' => true])->hint('Tidak ada/kecil/sedang/besar/multiple') ?></div>
                    <div class="col-md-3"><?= $form->field($model, 'palatum')->textInput(['class'=>'form-control','maxlength' => true])->hint('Dalam/sedang/rendah') ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><?= $form->field($model, 'supernumerary_teeth')->textInput(['class'=>'form-control','maxlength' => true])->hint('Tidak/ada') ?></div>
                    <div class="col-md-3"><?= $form->field($model, 'diastema')->textInput(['class'=>'form-control','maxlength' => true])->hint('Tidak/ada') ?></div>
                    <div class="col-md-3"><?= $form->field($model, 'gigi_anomali')->textInput(['class'=>'form-control','maxlength' => true])->hint('Tidak/ada') ?></div>
                    <div class="col-md-3"><?= $form->field($model, 'lain_lain')->textInput(['class'=>'form-control','maxlength' => true]) ?></div>
                </div>

                <br>
                <div class="form-group">
                    <?= Html::submitButton('Simpan Data Medik', ['class' => 'btn red']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Rawat Inap Gigi</span>
                </div>
            </div>
            <div class="portlet-body form">
                


            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['style' => 'text-align:center; width: 5%;'],
                        'headerOptions' => ['style' => 'text-align:center;'],
                    ],
                    [
                        'attribute' => 'tanggal',
                        'format' => ['date', 'php:d-F-Y'],
                        'contentOptions' => ['style' => 'width: 12%;'],     
                        'headerOptions' => ['style' => 'text-align:center;'],
                    ],
                    [
                        'attribute' => 'gigi',
                        'format' => 'ntext',
                        'contentOptions' => ['style' => 'width: 20%;'],     
                        'headerOptions' => ['style' => 'text-align:center;'],
                    ],
                    [
                        'attribute' => 'keluhan_diagnosa',
                        'format' => 'ntext',
                        'contentOptions' => ['style' => 'width: 20%;'],     
                        'headerOptions' => ['style' => 'text-align:center;'],
                    ],
                    [
                        'attribute' => 'perawatan',
                        'format' => 'ntext',
                        'contentOptions' => ['style' => 'width: 20%;'],     
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
                        'contentOptions' => ['style' => 'width: 12%; text-align:center;'],
                        'headerOptions' => ['style' => 'text-align:center;'],
                    ],
                    [
                        'class' => 'yii\grid\DataColumn',
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 12%; text-align:center;'],     
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
                'afterRow' => function ($rowmodel, $key, $index, $grid) use ($model){
                    $riDataCount = count($grid->dataProvider->models);
                    if ($index === $riDataCount - 1) {
                        $emptyRiGigi = new RiGigi();
                        
                        $formId = 'new-ri';
                        $id = EncryptionHelper::encrypt($model['rm_gigi_id']);

                        $form = ActiveForm::begin([
                            'id' => $formId, 
                            'action' => Url::to(['ri-gigi/create', 'rm_gigi_id' => $id]), 
                            'method' => 'post',
                            'options' => ['rm_gigi_id' => $model['rm_gigi_id'], 'enctype' => 'multipart/form-data'],
                        ]);
                        
                        $currentDate = Yii::$app->formatter->asDate(time(), 'dd-MMMM-yyyy');

                        $emptyRowContent = '<tr id="new-row">' .
                                            '<td style="text-align:center;">' . $riDataCount + 1 . '</td>' .
                                            '<td>' . $currentDate . '</td>' .
                                            '<td>' . $form->field($emptyRiGigi, 'gigi', ['options' => ['tag' => false]])->textInput(['class' => 'form-control', 'name' => 'gigi'])->label(false) . '</td>' .
                                            '<td>' . $form->field($emptyRiGigi, 'keluhan_diagnosa', ['options' => ['tag' => false]])->textInput(['class' => 'form-control', 'name' => 'keluhan_diagnosa'])->label(false) . '</td>' .
                                            '<td>' . $form->field($emptyRiGigi, 'perawatan', ['options' => ['tag' => false]])->textInput(['class' => 'form-control', 'name' => 'perawatan'])->label(false) . '</td>' .
                                            '<td></td>' .
                                            '<td style="text-align:center;">' . 
                                            Html::submitButton('Simpan', ['class' => 'btn btn-circle green-haze', 'id' => 'btn-simpan']) .
                                            Html::button('Batal', ['class' => 'btn btn-circle default', 'id' => 'btn-batal']) .
                                            '</td>' .
                                            '</tr>';

                        

                        return $emptyRowContent;
                    }
                    return null;
                },
            ]); ActiveForm::end(); ?>
            
            <p class="text-right">
                <?= Html::button('<span class="fa fa-plus"></span> Tambah Data', ['class' => 'btn btn-circle green-haze', 'id' => 'btn-tambah-data']) ?>
            </p>

            </div>
        </div>
    </div>
</div>


</div>

