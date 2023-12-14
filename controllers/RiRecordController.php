<?php

namespace app\controllers;

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
    public function actionCreate()
    {
        $model = new RiRecord();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ri_record_id' => $model->ri_record_id]);
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
        $this->findModel($ri_record_id)->delete();

        return $this->redirect(['index']);
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
}
