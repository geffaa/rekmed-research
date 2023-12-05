<?php

namespace app\controllers;

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
    public function actionCreate()
    {
        $model = new RiGigi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ri_gigi_id' => $model->ri_gigi_id]);
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
        $this->findModel($ri_gigi_id)->delete();

        return $this->redirect(['index']);
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
}
