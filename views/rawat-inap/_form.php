<?php

use app\components\EncryptionHelper;
use app\models\Pasien;
use app\models\RiRecord;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$pasien = new Pasien();

/** @var yii\web\View $this */
/** @var app\models\RawatInap $model */
/** @var yii\widgets\ActiveForm $form */

$currentDate = Yii::$app->formatter->asDate(time(), 'dd-MMMM-yyyy');
$emptyRiRecord = new RiRecord();
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

<div class="rawat-inap-form">

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-body form row">
                <div class="col-md-6">
                        <h2 class="caption-subject bold uppercase text-center">Catatan Perkembangan Pasien<br>Terintegrasi (CPPT)<br>Rawat Inap</h2>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered" style="width: 100%">
                        <tr>
                            <td style="width: 200px;">No. Rekam Medis</td>
                            <td><?= Html::encode($model->mr0->mr) ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>
                                <?php
                                $nama = $model->mr0->nama;
                                if ($nama !== null) {
                                    echo $nama;
                                } else {
                                    echo '<span class="text-danger" style="font-style: italic;">(not set)</span>';                            }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>
                            <?php
                                $originalDate = $model->mr0->tanggal_lahir;
                                $newDate = date("d-m-Y", strtotime($originalDate));
                                echo $newDate;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>
                                <?php
                                $jk = $model->mr0->jk;
                                if ($jk !== null) {
                                    echo $jk;
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
</div>

<div class="row">
    <div class="col-md-12">
                
            <?php if ($dataProvider->getCount() === 0): ?>

                <?php 
                $id = EncryptionHelper::encrypt($model['rawat_inap_id']);
                $form = ActiveForm::begin([
                    'id' => 'first-ri-record', 
                    'action' => Url::to(['ri-record/create', 'rawat_inap_id' => $id]), 
                    'method' => 'post',
                    'options' => ['rawat_inap_id' => $model['rawat_inap_id'], 'enctype' => 'multipart/form-data'],
                ]);
                ?>
                <table class="table table-bordered">
                    <thead>
                        <th style="text-align:center; font-weight: bold;">#</th>
                        <th style="text-align:center; font-weight: bold;">Tanggal</th>
                        <th style="text-align:center; font-weight: bold;">Subjective, Objective, Assessment</th>
                        <th style="text-align:center; font-weight: bold;">Plan</th>
                        <th style="text-align:center;"></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center;">1</td>
                            <td><?= $currentDate ?></td>
                            <td>
                                <?= $form->field($emptyRiRecord, 'subjective')->textInput(['class' => 'form-control', 'name' => 'subjective']) ?>
                                <?= $form->field($emptyRiRecord, 'objective')->textInput(['class' => 'form-control', 'name' => 'objective']) ?>
                                <?= $form->field($emptyRiRecord, 'assessment')->textInput(['class' => 'form-control', 'name' => 'assessment']) ?>
                            </td>
                            <td>
                                <?= $form->field($emptyRiRecord, 'plan')->textInput(['class' => 'form-control', 'name' => 'plan']) ?>
                            </td>
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
                        'contentOptions' => ['style' => 'text-align:center; width: 2%;'],
                        'headerOptions' => ['style' => 'text-align:center;'],
                    ],
                    [
                        'attribute' => 'tanggal',
                        'format' => ['date', 'php:d-F-Y'],
                        'contentOptions' => ['style' => 'width: 10%;'],     
                        'headerOptions' => ['style' => 'text-align:center;'],
                    ],
                    [
                        'label' => 'Profesi',
                        'format' => 'ntext',
                        'contentOptions' => ['style' => 'width: 10%;'],     
                        'headerOptions' => ['style' => 'text-align:center;'],
                        'value' => function ($model) {
                            return $model->user->dokter->pekerjaan;
                        }
                    ],
                    [
                        'label' => 'Subjective, Objective, Assessment',
                        'format' => 'ntext',
                        'contentOptions' => ['style' => 'width: 20%;'],     
                        'headerOptions' => ['style' => 'text-align:center;'],
                        'value' => function ($model) {
                            return $model->subjective . PHP_EOL . $model->objective . PHP_EOL . $model->assessment;
                        }
                    ],
                    [
                        'attribute' => 'plan',
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
                                $id = EncryptionHelper::encrypt($model->ri_record_id);
                                return Html::a(
                                    'Verify',
                                    ['ri-record/verify', 'ri_record_id' => $id],
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
                        'contentOptions' => ['style' => 'width: 10%; text-align:center;'],     
                        'value' => function ($model) {

                            $ri_record_id = EncryptionHelper::encrypt($model['ri_record_id']);

                            $buttons = Html::a('Edit', ['edit', 'id' => $model['ri_record_id']], [
                                            'class' => 'btn btn-circle green-haze',
                                            'onclick' => 'editRecord(' . $model['ri_record_id'] . '); return false;',
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
                                                        url: '" . Url::to(['ri-record/delete', 'ri_record_id' => $ri_record_id]) . "',
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
                        $emptyRiRecord = new RiRecord();
                        $id = EncryptionHelper::encrypt($model['rawat_inap_id']);

                        $form = ActiveForm::begin([
                            'id' => 'new-ri', 
                            'action' => Url::to(['ri-record/create', 'rawat_inap_id' => $id]), 
                            'method' => 'post',
                            'options' => ['rawat_inap_id' => $model['rawat_inap_id'], 'enctype' => 'multipart/form-data'],
                        ]);
                        
                        $currentDate = Yii::$app->formatter->asDate(time(), 'dd-MMMM-yyyy');

                        $emptyRowContent = '<tr id="new-row">' .
                                            '<td style="text-align:center;">' . $riDataCount + 1 . '</td>' .
                                            '<td>' . $currentDate . '</td>' .
                                            '<td></td>' .
                                            '<td>' . 
                                            $form->field($emptyRiRecord, 'subjective', ['options' => ['tag' => false]])->textInput(['class' => 'form-control', 'name' => 'subjective']) .
                                            $form->field($emptyRiRecord, 'objective', ['options' => ['tag' => false]])->textInput(['class' => 'form-control', 'name' => 'objective']) . 
                                            $form->field($emptyRiRecord, 'assessment', ['options' => ['tag' => false]])->textInput(['class' => 'form-control', 'name' => 'assessment'])
                                            . '</td>' .
                                            '<td>' . $form->field($emptyRiRecord, 'plan', ['options' => ['tag' => false]])->textInput(['class' => 'form-control', 'name' => 'plan']) . '</td>' .
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
