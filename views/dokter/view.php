<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Pasien;
use yii\helpers\Url;

$pasien = new Pasien();

$this->registerCssFile('@web/metronic/pages/css/profile.min.css',['depends'=>'app\assets\MetronicAsset']);

/* @var $this yii\web\View */
/* @var $model app\models\Dokter */

$this->title = 'Profil : '.Html::encode($model->nama);
?>
<center><h3>Profil Dokter</h3></center>
<br/>
<div class="row">
    <div class="col-md-3">
        <div class="profile-userpic">
            <?= empty($model->foto) ? Html::img('@web/img/DR-avatar.png',['class'=>'img-responsive']) : Html::img('@web/'.$model->foto,['class'=>'img-responsive']) ?>
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"> <?= Html::encode($model->nama) ?> </div>
            <div class="profile-usertitle-job"> <?= !empty($model->tanggal_lahir) ? $pasien->getAge($model->tanggal_lahir).' Tahun' : '-' ?>     </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->
        <div class="profile-userbuttons">
            <?= Html::a('Update Data Dokter', ['update', 'id' => $model->user_id], ['class' => 'btn btn-circle green btn-sm']) ?>
            <?php echo Yii::$app->user->identity->role==10? Html::a('Masuk Mode Simulasi', ['switch-role', 'id' => $model->user_id], ['class' => 'btn btn-circle red btn-sm']):"" ?>
        </div>
    </div>
    <div class="col-md-9">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'no_nik',
                'nama',
                'jenis_kelamin',
                'tanggal_lahir',
                'spesialisasi.nama',
                'no_telp',
                'no_telp_2',
                'kota.kokab_nama',
                'email',
                'alumni',
                'pekerjaan',
                'alamat:ntext',
                'created',
                [
                    'attribute' => 'no_ihs',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->no_ihs === null) {
                            $button = Html::a('Daftar ke SATUSEHAT', ['dokter/daftar-satusehat-dokter', 'id'=>utf8_encode(Yii::$app->security->encryptByKey( $model->user_id, Yii::$app->params['kunciInggris'] ))], ['class' => 'btn btn-circle green btn-sm']);
                            return 'Belum terdaftar &nbsp;&nbsp;'. $button;
                        } else {
                            return 'Sudah terdaftar';
                        }
                    },
                    'label' => 'Status SATUSEHAT',
                ],
            ],
        ]) ?>
    </div>
</div>
<hr>
<center><h3>Profil Klinik</h3></center>
<br/>
<div class="row">
    <div class="col-md-3">
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"> <?= Html::encode($model_klinik->klinik_nama) ?> </div>
            <div class="profile-usertitle-job"><?= Html::encode($model_klinik->alamat) ?></div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->
        <div class="profile-userbuttons">
            <?= Html::a('Update Data Klinik', ['update-klinik', 'id' => $model->user_id], ['class' => 'btn btn-circle green btn-sm']) ?>
        </div>
    </div>
    <div class="col-md-9">
        <?= DetailView  ::widget([
            'model' => $model_klinik,
            'attributes' => [
                'klinik_nama',
                'alamat:ntext',
                'nomor_telp_1',
                'nomor_telp_2',
                'kepala_klinik',
                [
                    'attribute' => 'organization_id',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->organization_id === null) {
                            $button = Html::a('Daftarkan klinik ke SATUSEHAT', ['dokter/daftar-satusehat-klinik', 'id'=>utf8_encode(Yii::$app->security->encryptByKey( $model->klinik_id, Yii::$app->params['kunciInggris'] ))], ['class' => 'btn btn-circle green btn-sm']);
                            return 'Klinik belum terdaftar &nbsp;&nbsp;'. $button;
                        } else {
                            return 'Klinik sudah terdaftar';
                        }
                    },
                    'label' => 'Status SATUSEHAT',
                ],
            ],
        ]) ?>
    </div>
</div>

