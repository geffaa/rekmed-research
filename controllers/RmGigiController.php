<?php

namespace app\controllers;

use Yii;
use app\models\RmGigi;
use app\models\RmGigiSearch;
use app\models\RiGigi;
use app\models\RiGigiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\EncryptionHelper;

/**
 * RmGigiController implements the CRUD actions for RmGigi model.
 */
class RmGigiController extends Controller
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
     * Lists all RmGigi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RmGigiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RmGigi model.
     * @param int $rm_gigi_id Rm Gigi ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($rm_gigi_id)
    {
        $rm_gigi_id = EncryptionHelper::decrypt($rm_gigi_id);
        return $this->render('view', [
            'model' => $this->findModel($rm_gigi_id),
        ]);
    }

    /**
     * Creates a new RmGigi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new RmGigi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'rm_gigi_id' => $model->rm_gigi_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RmGigi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $rm_gigi_id Rm Gigi ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($rm_gigi_id)
    {
        $rm_gigi_id = EncryptionHelper::decrypt($rm_gigi_id);
        $model = $this->findModel($rm_gigi_id);
        
        $searchModel = new RiGigiSearch();
        $dataProvider = $searchModel->getDataProviderByRmGigiId($rm_gigi_id);

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
     * Deletes an existing RmGigi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $rm_gigi_id Rm Gigi ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($rm_gigi_id)
    {
        $rm_gigi_id = EncryptionHelper::decrypt($rm_gigi_id);
        // $this->findModel($rm_gigi_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RmGigi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $rm_gigi_id Rm Gigi ID
     * @return RmGigi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($rm_gigi_id)
    {
        if (($model = RmGigi::findOne(['rm_gigi_id' => $rm_gigi_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
