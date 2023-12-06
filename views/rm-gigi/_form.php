<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pasien;

$pasien = new Pasien();

/** @var yii\web\View $this */
/** @var app\models\RmGigi $model */
/** @var yii\widgets\ActiveForm $form */
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
                <?php
                    echo $this->render('/ri-gigi/index', compact('dataProvider'));
                ?>

                <br><br>
                <div class="form-group">
                    <?= Html::submitButton('Simpan Data Medik', ['class' => 'btn red']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


</div>
