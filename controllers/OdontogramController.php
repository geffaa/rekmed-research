<?php

namespace app\controllers;

use app\models\Gigi;
use app\models\Odontogram;
use app\models\OdontogramSearch;
use app\models\StatusGigi;
use yii\data\ActiveDataProvider;
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
     * @param int $odontogram_id Odontogram ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($rm_gigi_id)
    {
        $searchModel = new OdontogramSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $daftarGigi = Gigi::find()->all();
        $dataProviderGigi = new ActiveDataProvider([
            'query' => StatusGigi::find(),
            'pagination' => [
                'pageSize' => 10, // Adjust the number of items per page as needed
            ],
            // You can add sorting or other configuration options here
        ]);
        
        $daftarStatusGigi = $dataProviderGigi->getModels();

        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'daftarGigi' => $daftarGigi,
            'daftarStatusGigi' => $daftarStatusGigi,
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
                return $this->redirect(['view', 'odontogram_id' => $model->odontogram_id]);
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
     * @param int $odontogram_id Odontogram ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($odontogram_id)
    {
        $model = $this->findModel($odontogram_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'odontogram_id' => $model->odontogram_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Odontogram model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $odontogram_id Odontogram ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($odontogram_id)
    {
        $this->findModel($odontogram_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Odontogram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $odontogram_id Odontogram ID
     * @return Odontogram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($odontogram_id)
    {
        if (($model = Odontogram::findOne(['odontogram_id' => $odontogram_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
