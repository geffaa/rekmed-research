<?php

use app\components\EncryptionHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pasien;
use yii\grid\GridView;
use app\models\RiGigi;
use yii\helpers\Url;
use yii\web\View;

$pasien = new Pasien();

/** @var yii\web\View $this */
/** @var app\models\RmGigi $model */
/** @var yii\widgets\ActiveForm $form */

$currentDate = Yii::$app->formatter->asDate(time(), 'dd-MMMM-yyyy');
$emptyRiGigi = new RiGigi();
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
                <?php $form = ActiveForm::begin([
                    'action' => ['rm-gigi/update', 'rm_gigi_id' => EncryptionHelper::encrypt($model->rm_gigi_id)],
                ]); ?>

                <?= $form->field($model, 'rm_id')->hiddenInput(['value' => $model->rm_id])->label(false) ?>
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
                    <span class="caption-subject bold uppercase">Odontogram</span>
                </div>
            </div>
            <div class="portlet-body form">
                <?= Html::a('Lihat Odontogram', ['odontogram/index'], ['class' => 'btn red']) ?>
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
                
            <?php if ($dataProvider->getCount() === 0): ?>

                <?php 
                $id = EncryptionHelper::encrypt($model['rm_gigi_id']);
                ActiveForm::begin([
                    'id' => 'first-ri', 
                    'action' => Url::to(['ri-gigi/create', 'rm_gigi_id' => $id]), 
                    'method' => 'post',
                    'options' => ['rm_gigi_id' => $model['rm_gigi_id'], 'enctype' => 'multipart/form-data'],
                ]);
                ?>
                <table class="table table-bordered">
                    <thead>
                        <th style="text-align:center;">#</th>
                        <th style="text-align:center;">Tanggal</th>
                        <th style="text-align:center;"> <?= $model->getAttributeLabel('gigi'); ?> </th>
                        <th style="text-align:center;"> <?= $model->getAttributeLabel('keluhan_diagnosa'); ?> </th>
                        <th style="text-align:center;"> <?= $model->getAttributeLabel('perawatan'); ?> </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center;">1</td>
                            <td><?= $currentDate ?></td>
                            <td><?= $form->field($emptyRiGigi, 'gigi')->textInput(['class' => 'form-control', 'name' => 'gigi'])->label(false) ?></td>
                            <td><?= $form->field($emptyRiGigi, 'keluhan_diagnosa')->textInput(['class' => 'form-control', 'name' => 'keluhan_diagnosa'])->label(false) ?></td>
                            <td><?= $form->field($emptyRiGigi, 'perawatan')->textInput(['class' => 'form-control', 'name' => 'perawatan'])->label(false) ?></td>
                            <td style="text-align:center;">
                                <?= Html::submitButton('Simpan', ['class' => 'btn btn-circle green-haze', 'id' => 'btn-simpan2']) ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php ActiveForm::end(); ?>

            <?php else: ?>
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
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 12%; text-align:center;'],
                        'headerOptions' => ['style' => 'text-align:center;'],
                        'value' => function ($model) {
                            if ($model->is_verified == 1) {
                                return Html::img('@web/' . $model->user->dokter->ttd, [
                                    'id' => "ttd", 
                                    'alt' => "Tanda tangan", 
                                    'style' => 'width:100px; height:auto;',
                                ]);
                            } else {
                                $id = EncryptionHelper::encrypt($model->ri_gigi_id);
                                return Html::a(
                                    'Verify',
                                    ['ri-gigi/verify', 'ri_gigi_id' => $id],
                                    [
                                        'class' => 'btn btn-circle default',
                                        'data' => [
                                            'method' => 'post',
                                        ],
                                    ]);
                            }
                        },
                    ],
                    [
                        'class' => 'yii\grid\DataColumn',
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 12%; text-align:center;'],     
                        'value' => function ($model) {

                            $ri_gigi_id = EncryptionHelper::encrypt($model['ri_gigi_id']);

                            $buttons = Html::a('Edit', ['edit', 'id' => $model['ri_gigi_id']], [
                                            'class' => 'btn btn-circle green-haze',
                                            'onclick' => 'editRecordGigi(' . $model['ri_gigi_id'] . '); return false;',
                                            ]) 
                                        . ' ' .
                                        Html::a(
                                            'Hapus',
                                            'javascript:void(0);', // The link won't navigate anywhere
                                            [
                                                'class' => 'btn btn-circle red',
                                                'title' => Yii::t('yii', 'Hapus'),
                                                'onclick' => "
                                                var confirmed = confirm('Anda yakin ingin menghapus data ini?');
                                                if (confirmed) {
                                                    var csrfToken = $('meta[name=\"csrf-token\"]').attr('content');
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '" . Url::to(['ri-gigi/delete', 'ri_gigi_id' => $ri_gigi_id]) . "',
                                                        data: {
                                                            _csrf: csrfToken,
                                                        },
                                                        success: function(response) {
                                                            location.reload();
                                                        },
                                                        error: function(error) {
                                                        }
                                                    });
                                                }
                                            ",
                                        ]
                                    );
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
                        $id = EncryptionHelper::encrypt($model['rm_gigi_id']);

                        $form = ActiveForm::begin([
                            'id' => 'new-ri', 
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
            
            <?php endif; ?>


            </div>
        </div>
    </div>
</div>


</div>

