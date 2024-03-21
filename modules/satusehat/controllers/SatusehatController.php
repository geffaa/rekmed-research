<?php

namespace app\modules\satusehat\controllers;

use yii\web\Controller;

/**
 * Default controller for the `satusehat` module
 */
class SatusehatController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
