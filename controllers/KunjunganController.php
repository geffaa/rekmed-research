<?php

namespace app\controllers;

use app\models\satusehat\Location;
use app\models\satusehat\Organization;
use app\models\satusehat\Practitioner;
use Yii;
use app\models\Kunjungan;
use app\models\KunjunganSearch;

use app\models\RmDiagnosis;
use app\models\RmDiagnosisBanding;
use app\models\RmObat;
use app\models\RmObatRacik;
use app\models\RmObatRacikKomponen;
use app\models\RmTindakan;
use app\models\RekamMedis;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\AccessRule;
use app\models\satusehat\Encounter;
use yii\filters\AccessControl;
use app\models\User;

/**
 * KunjunganController implements the CRUD actions for Kunjungan model.
 */
class KunjunganController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                   'class' => AccessControl::className(),
                   'ruleConfig' => [
                       'class' => AccessRule::className(),
                   ],
                   'only' => ['index','create', 'update', 'delete','view','pemeriksaan','bayar','process'],
                   'rules' => [
                       [
                           'actions' => ['index','create', 'update', 'delete','view','pemeriksaan','bayar','process'],
                           'allow' => true,
                           'roles' => [
                               User::ROLE_ADMIN, User::ROLE_DOKTER_ADMIN, User::ROLE_DOKTER
                           ], 
                       ]
                   ],
            ],
        ];
    }

    /**
     * Lists all Kunjungan models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $sisa = Kunjungan::getSisaRm();
        $searchModel = new KunjunganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,false,false,'antri');

        return $this->render('index', [
            // 'sisa' => $sisa,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPemeriksaan()
    {
        $searchModel = new KunjunganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,true,false,'pemeriksaan');

        return $this->render('pemeriksaan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFarmasi()
    {
        $searchModel = new KunjunganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,true,true,'antri obat');
        
        return $this->render('farmasi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBayar()
    {
        $searchModel = new KunjunganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,true,true,'antri bayar');

        return $this->render('bayar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kunjungan model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    /**
     * Creates a new Kunjungan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($asal = null)
    {
        $model = new Kunjungan();
        $post_data = Yii::$app->request->post();
        if (!empty($post_data)) {
            $model->klinik_id = Yii::$app->user->identity->klinik_id;
            $model->tanggal_periksa = date('Y-m-d');
            $model->jam_masuk = date('Y-m-d H:i:s');
            $model->created = date('Y-m-d H:i:s');
            $model->status = 'antri';
            $model->user_input = Yii::$app->user->identity->username;
            $model->user_id = Yii::$app->user->identity->id;
            $model->mr = $post_data['mr'];
            $model->dokter_periksa = $post_data['Kunjungan']['dokter_periksa'];
            $model->nomor_antrian = Kunjungan::hitAntrian(Yii::$app->user->identity->klinik_id,$model->tanggal_periksa);
            $model->save();
            \Yii::$app->getSession()->setFlash('success', 'Berhasil Menambahkan ke Antrian');

            $pasien = $model->getMr0()->one();
            $encounter = new Encounter();
            $encounter->addRegistrationId($model->kunjungan_id);
            $statusHistory = [
                'arrived' => $model->jam_masuk,
            ];
            $encounter->addStatusHistory($statusHistory);
            $encounter->setConsultationMethod('RAJAL');
            $encounter->setSubject($pasien->no_ihs, $pasien->nama);

            $practitioner = new Practitioner();
            $dokter = $model->getDokter0()->one();
            $practitioner = $practitioner->getSSNik($dokter->no_nik);
            $ihsDokter = $dokter->no_ihs;
            if ($ihsDokter != null)
                $encounter->addParticipant($ihsDokter, $dokter->no_nik);
            
            $klinik = $model->getKlinik()->one();
            $locationId = $klinik->location_id;
            $klinikOrgId = $klinik->organization_id;
            if ($locationId === null) {
                $location = new Location();
                $location->setStatus();
                $location->addIdentifier($klinik->klinik_id);
                $location->setName($klinik->alamat, $klinik->alamat);
                $location->addPhysicalType('bu');
                if ($klinik->nomor_telp_1 != null)
                    $location->addPhone($klinik->nomor_telp_1);
                if ($klinik->nomor_telp_2 != null)
                    $location->addPhone($klinik->nomor_telp_2);
                $location->addPosition();

                if ($klinikOrgId == null) {
                    $organization = new Organization();
                    $organization->addIdentifier($klinik->klinik_id);
                    if ($klinik->klinik_nama)
                        $organization->setName($klinik->klinik_nama);
                    if ($klinik->alamat)
                        $organization->setAddressLine($klinik->alamat);
                    if ($klinik->nomor_telp_1)
                        $organization->addPhone($klinik->nomor_telp_1);
                    if ($klinik->nomor_telp_2)
                        $organization->addPhone($klinik->nomor_telp_2);
                    $organization->setType('prov');
                    $organization->setPartOf();
                    [$klinikOrgId, $errorMessage] = $organization->post();
                    $klinik->organization_id = $klinikOrgId;
                    $klinik->save();
                }

                $location->setManagingOrganization($klinikOrgId);
                [$locationId, $errorMessage] = $location->post();
                $klinik->location_id = $locationId;
                $klinik->save();
            }
            $encounter->addLocation($locationId, $klinik->alamat);
            
            // Belum ada diagnosis saat penambahan pasien ke antria
            $encounter->addDiagnosis(0, 0, 'null');
            $encounter->setServiceProvider($klinikOrgId);
            [$encounterUuid, $errorMessage] = $encounter->post();
            
            $model->encounter_id = $encounterUuid;
            $model->save();

            if(!empty($asal)){
                return $this->redirect([$asal]);
            }
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Kunjungan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kunjungan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionProcess($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kunjungan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Kunjungan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $rm_id = RekamMedis::findAll(['kunjungan_id'=>$id]);
        foreach ($rm_id as $key => $value) {
            RmDiagnosis::deleteAll(['rm_id'=>$value['rm_id']]);
            RmDiagnosisBanding::deleteAll(['rm_id'=>$value['rm_id']]);
            RmObat::deleteAll(['rm_id'=>$value['rm_id']]);
            RmTindakan::deleteAll(['rm_id'=>$value['rm_id']]);
            $rm_obatracik = RmObatRacik::findAll(['rm_id'=>$value['rm_id']]);
            foreach ($rm_obatracik as $val)
                RmObatRacikKomponen::deleteAll(['racik_id'=>$val['racik_id']]);
            RmObatRacik::deleteAll(['rm_id'=>$value['rm_id']]);

            $this->findModelRm($rm_id)->delete();
        }

        $this->findModel($id)->delete();
        \Yii::$app->getSession()->setFlash('success', 'Berhasil Dihapus dari Antrian');
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Kunjungan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kunjungan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kunjungan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelRm($id)
    {
        if (($model = RekamMedis::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
