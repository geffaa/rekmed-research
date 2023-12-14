<?php

namespace app\controllers;

use Yii;
use app\components\EncryptionHelper;
use app\models\RiRecord;
use app\models\RiRecordSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RiRecordController implements the CRUD actions for RiRecord model.
 */
class RiRecordController extends Controller
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
     * Lists all RiRecord models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RiRecordSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RiRecord model.
     * @param int $ri_record_id Ri Record ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ri_record_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($ri_record_id),
        ]);
    }

    /**
     * Creates a new RiRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($rawat_inap_id)
    {
        $id = EncryptionHelper::decrypt($rawat_inap_id);
        $model = new RiRecord();
        
        if ($this->request->isPost) {
            try {
                $post_data = Yii::$app->request->post();
                if ($model->load($post_data, '')) {
                
                    $model->rawat_inap_id = $id;
                    $model->user_id = Yii::$app->user->identity->id;
                    $model->tanggal = date('Y-m-d H:i:s');

                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Berhasil menyimpan data');
                    } else {
                        Yii::$app->session->setFlash('error', 'Gagal menyimpan data');
                    }
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    $errorString = '';
                    foreach ($model->errors as $attribute => $errorMessages) {
                        foreach ($errorMessages as $errorMessage) {
                            $errorString .= "Validation Error for $attribute: $errorMessage\n";
                        }
                    }
                    Yii::$app->session->setFlash('error', $errorString);
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'Terdapat error!');
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RiRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ri_record_id Ri Record ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ri_record_id)
    {
        $model = $this->findModel($ri_record_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ri_record_id' => $model->ri_record_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RiRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ri_record_id Ri Record ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ri_record_id)
    {
        $id = EncryptionHelper::decrypt($ri_record_id);
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
     * Finds the RiRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ri_record_id Ri Record ID
     * @return RiRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ri_record_id)
    {
        if (($model = RiRecord::findOne(['ri_record_id' => $ri_record_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionVerify($ri_record_id)
    {
        $id = EncryptionHelper::decrypt($ri_record_id);
        $model = $this->findModel($id);

        if ($model->user_id === Yii::$app->user->identity->id) {
            $model->is_verified = 1;
            $model->save();
        } else {
            Yii::$app->getSession()->setFlash('error', 'Tidak dapat memverifikasi rawat inap karena Anda bukan ' . $model->user->dokter->nama);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
