<?php

namespace app\controllers;

use yii\web\Controller;

use app\components\OAuth2Client;
use app\models\satusehat\Encounter;
use app\models\satusehat\Patient;
use Carbon\Carbon;
use Yii;

/**
 * Controller for the `fhir` module
 */
class FhirController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function token()
    {
        $oauth2Client = new OAuth2Client();
        $accessToken = $oauth2Client->token();

        if ($accessToken !== null) {
            $response = $oauth2Client->get_by_id('resource', 'id');
            return $this->asJson($response);
        } else {
            return $this->asJson(['error' => 'Token not obtained']);
        }
    }
}
