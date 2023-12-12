<?php

namespace app\controllers;

use app\models\Odontogram;
use app\models\OdontogramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OdontogramController implements the CRUD actions for Odontogram model.
 */
class OdontogramController extends Controller
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
     * Lists all Odontogram models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OdontogramSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Odontogram model.
     * @param int $rm_gigi_id Rm Gigi ID
     * @param int $gigi_id Gigi ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewOriginal($rm_gigi_id, $gigi_id)
    {
        return $this->render('view_original', [
            'model' => $this->findModel($rm_gigi_id, $gigi_id),
        ]);
    }

    /**
     * Displays a single Odontogram model.
     * @param int $rm_gigi_id Rm Gigi ID
     * @param int $gigi_id Gigi ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($rm_gigi_id)
    {
        $searchModel = new OdontogramSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('view', [
            // 'model' => $this->findModel($rm_gigi_id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Odontogram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Odontogram();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'rm_gigi_id' => $model->rm_gigi_id, 'gigi_id' => $model->gigi_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Odontogram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $rm_gigi_id Rm Gigi ID
     * @param int $gigi_id Gigi ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($rm_gigi_id, $gigi_id)
    {
        $model = $this->findModel($rm_gigi_id, $gigi_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rm_gigi_id' => $model->rm_gigi_id, 'gigi_id' => $model->gigi_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Odontogram model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $rm_gigi_id Rm Gigi ID
     * @param int $gigi_id Gigi ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($rm_gigi_id, $gigi_id)
    {
        $this->findModel($rm_gigi_id, $gigi_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Odontogram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $rm_gigi_id Rm Gigi ID
     * @param int $gigi_id Gigi ID
     * @return Odontogram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($rm_gigi_id, $gigi_id)
    {
        if (($model = Odontogram::findOne(['rm_gigi_id' => $rm_gigi_id, 'gigi_id' => $gigi_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
