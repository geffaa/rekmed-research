<?php

namespace app\modules\fhir\controllers;

use app\components\OAuth2Client;
use app\modules\fhir\models\Encounter;
use app\modules\fhir\models\Patient;
use yii\web\Controller;
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

    public function actionDemo()
    {
        $encounter = new Encounter();
        $statusHistory = [
            'arrived' => Carbon::now()->subMinutes(15)->toDateTimeString(),
            'inprogress' => Carbon::now()->subMinutes(5)->toDateTimeString(),
            'finished' => Carbon::now()->toDateTimeString()
        ];

        $encounter->addRegistrationId('123456789'); // unique string free text (increments / UUID)
        $encounter->addStatusHistory($statusHistory); // array of timestamp
        $encounter->setConsultationMethod('RAJAL'); // RAJAL, IGD, RANAP, HOMECARE, TELEKONSULTASI
        $encounter->setSubject('P12312312123', 'TESTER'); // ID SATUSEHAT Pasien dan Nama SATUSEHAT
        $encounter->addParticipant('102938712983', 'dr. X'); // ID SATUSEHAT Dokter, Nama Dokter
        $encounter->addLocation('A1-001', 'Ruang Poli A1'); // ID SATUSEHAT Location, Nama Poli
        $encounter->addDiagnosis(Yii::$app->security->generateRandomString(), 'J06.9'); // ID SATUSEHAT Condition, Kode ICD10
        $encounterJson = $encounter->json();

        return $this->render('demo', ['encounter' => $encounterJson]);
    }

    public function actionDemo2()
    {
        $patient = new Patient();

        [$statusCode, $res] = $patient->getById('P02428473601');

        $resJson = json_encode($res, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        return $this->render('demo2', ['statusCode' => $statusCode, 'res' => $resJson]);
    }
}
