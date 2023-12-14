<?php

namespace app\controllers;

use app\components\EncryptionHelper;
use Yii;
use app\models\RiGigi;
use app\models\RiGigiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RiGigiController implements the CRUD actions for RiGigi model.
 */
class RiGigiController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all RiGigi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RiGigiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RiGigi model.
     * @param int $ri_gigi_id Ri Gigi ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ri_gigi_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($ri_gigi_id),
        ]);
    }

    /**
     * Creates a new RiGigi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($rm_gigi_id = null)
    {
        $id = EncryptionHelper::decrypt($rm_gigi_id);
        $model = new RiGigi();
        
        if ($this->request->isPost) {
            try {
                $post_data = Yii::$app->request->post();

                $gigi = Yii::$app->request->post('gigi');
                $keluhanDiagnosa = Yii::$app->request->post('keluhan_diagnosa');
                $perawatan = Yii::$app->request->post('perawatan');

                $model->rm_gigi_id = $id;
                $model->user_id = Yii::$app->user->identity->id;
                $model->tanggal = date('Y-m-d H:i:s');
                $model->is_verified = 0;
                $model->gigi = $gigi;
                $model->keluhan_diagnosa = $keluhanDiagnosa;
                $model->perawatan = $perawatan;

                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Berhasil menyimpan data');
                        // $postDataString = json_encode($post_data, JSON_PRETTY_PRINT);
                        // Yii::$app->session->setFlash('success', 'Record has been created successfully. POST data: <pre>' . $postDataString . '</pre>');
                    } else {
                        Yii::$app->session->setFlash('error', 'Gagal menyimpan data');
                    }
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    // $errorString = '';
                    // foreach ($model->errors as $attribute => $errorMessages) {
                    //     foreach ($errorMessages as $errorMessage) {
                    //         $errorString .= "Validation Error for $attribute: $errorMessage\n";
                    //     }
                    // }
                    // Yii::$app->session->setFlash('error', $errorString);
                    Yii::$app->session->setFlash('error', 'Data tidak valid');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'Terdapat error!');
                // Yii::$app->session->setFlash('error', $e);
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing RiGigi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ri_gigi_id Ri Gigi ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ri_gigi_id)
    {
        $model = $this->findModel($ri_gigi_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ri_gigi_id' => $model->ri_gigi_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RiGigi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ri_gigi_id Ri Gigi ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ri_gigi_id)
    {
        $id = EncryptionHelper::decrypt($ri_gigi_id);
        $model = $this->findModel($id);

        if ($model->delete()) {
            Yii::$app->getSession()->setFlash('success', 'Data berhasil dihapus');
            return $this->asJson(['success' => true]);
        } else {
            Yii::$app->getSession()->setFlash('error', 'Gagal menghapus data');
            return $this->asJson(['success' => false]);
        }
    }

    /**
     * Finds the RiGigi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ri_gigi_id Ri Gigi ID
     * @return RiGigi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ri_gigi_id)
    {
        if (($model = RiGigi::findOne(['ri_gigi_id' => $ri_gigi_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionVerify($ri_gigi_id)
    {
        $id = EncryptionHelper::decrypt($ri_gigi_id);
        $model = $this->findModel($id);

        if ($model->user_id === Yii::$app->user->identity->id) {
            $model->is_verified = 1;
            $model->save();
        } else {
            Yii::$app->getSession()->setFlash('error', 'Tidak dapat memverifikasi rawat inap gigi karena Anda bukan ' . $model->user->dokter->nama);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
