<?php

namespace app\controllers;

use app\components\EncryptionHelper;
use app\models\RawatInap;
use app\models\RawatInapSearch;
use app\models\RiRecordSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RawatInapController implements the CRUD actions for RawatInap model.
 */
class RawatInapController extends Controller
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
     * Lists all RawatInap models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RawatInapSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RawatInap model.
     * @param int $rawat_inap_id Rawat Inap ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($rawat_inap_id)
    {
        $id = EncryptionHelper::decrypt($rawat_inap_id);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RawatInap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new RawatInap();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'rawat_inap_id' => $model->rawat_inap_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RawatInap model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $rawat_inap_id Rawat Inap ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($rawat_inap_id)
    {
        $rawat_inap_id = EncryptionHelper::decrypt($rawat_inap_id);
        $model = $this->findModel($rawat_inap_id);
        
        $searchModel = new RiRecordSearch();
        $dataProvider = $searchModel->getDataProviderByRawatInapId($rawat_inap_id);

        if ($this->request->isPost) {
            try {
                $attributeNames = $model->attributes();
                foreach ($attributeNames as $attribute) {
                    $value = Yii::$app->request->post($attribute);
                    $model->$attribute = $value;
                }
                $model->load($this->request->post());

                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Berhasil menyimpan data');
                    } else {
                        Yii::$app->session->setFlash('error', 'Gagal menyimpan data');
                    }
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    Yii::$app->session->setFlash('error', 'Data tidak valid');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'Terdapat error!');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing RawatInap model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $rawat_inap_id Rawat Inap ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($rawat_inap_id)
    {
        $this->findModel($rawat_inap_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RawatInap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $rawat_inap_id Rawat Inap ID
     * @return RawatInap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($rawat_inap_id)
    {
        if (($model = RawatInap::findOne(['rawat_inap_id' => $rawat_inap_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
