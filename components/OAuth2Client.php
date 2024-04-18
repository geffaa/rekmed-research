<?php

namespace app\components;

use app\models\satusehat\SatusehatLog;
use app\models\satusehat\SatusehatToken;
use yii\base\Component;
use yii\base\InvalidConfigException;
use Yii;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use yii\helpers\Json;

class OAuth2Client extends Component
{
    public $patient_dev = ['P02478375538', 'P02428473601', 'P03647103112', 'P01058967035', 'P01836748436', 'P01654557057', 'P00805884304', 'P00883356749', 'P00912894463'];
    public $practitioner_dev = ['10009880728', '10006926841', '10001354453', '10010910332', '10018180913', '10002074224', '10012572188', '10018452434', '10014058550', '10001915884'];

    public $auth_url;
    public $base_url;
    public $client_id;
    public $client_secret;
    public $organization_id;

    public function __construct($config = [])
    {
        parent::__construct($config);

        
        $this->auth_url = Yii::$app->params['SATUSEHAT_AUTH_DEV'];
        $this->base_url = Yii::$app->params['SATUSEHAT_FHIR_DEV'];
        $this->organization_id = Yii::$app->params['ORGID_DEV'];
        $this->client_id = Yii::$app->params['CLIENTID_DEV'];
        $this->client_secret = Yii::$app->params['CLIENTSECRET_DEV'];

        if ($this->organization_id === null) {
            throw new InvalidConfigException('Add your organization_id at environment first');
        }
    }

    public function token()
    {
        // Check if a valid token exists and has not expired
        $token = SatusehatToken::findValidToken();


        if ($token !== null) {
            return $token->token;
        }
        
        // If no valid token exists or has expired, request a new token
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $options = [
            'form_params' => [
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
            ],
        ];

        try {
            $response = $client->post($this->auth_url.'/accesstoken?grant_type=client_credentials', [
                'headers' => $headers,
                'form_params' => $options['form_params'],
            ]);

            $data = json_decode($response->getBody(), true);
            if (isset($data['access_token'])) {
                SatusehatToken::saveToken($data['access_token'], $data['expires_in']);
                return $data['access_token'];
            } else {
                error_log('Failed to obtain token: ' . json_encode($data));
                return null;
            }
        } catch (RequestException $e) {
            error_log('Failed to make token request: ' . $e->getMessage());
            return null;
        }
    }
    
    public function ss_post($resource, $body)
    {
        $access_token = $this->token();

        if (!isset($access_token)) {
            $oauth2 = [
                'statusCode' => 401,
                'res' => 'Unauthorized. Token not found',
            ];
            return $this->respondError($oauth2);
        }
        
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $access_token,
        ];
        

        $url = $this->base_url . ($resource == 'Bundle' ? '' : '/' . $resource);

        try {
            $response = $client->post($url, [
                'headers' => $headers,
                'body' => json_encode($body),
            ]);
            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            $this->log($statusCode, 'POST', $url, json_encode($body, JSON_PRETTY_PRINT), json_encode($responseBody, JSON_PRETTY_PRINT));
            return [$statusCode, $responseBody];
        } catch (BadResponseException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $responseBody = json_decode($e->getResponse()->getBody()->getContents(), true);

            $this->log($statusCode, 'POST', $url, json_encode($body, JSON_PRETTY_PRINT), json_encode($responseBody, JSON_PRETTY_PRINT));
            return [$statusCode, $responseBody];
        }
    }   

    public function ss_get($path)
    {
        $access_token = $this->token();

        if (!isset($access_token)) {
            $oauth2 = [
                'statusCode' => 401,
                'res' => 'Unauthorized. Token not found',
            ];
            return $this->respondError($oauth2);
        }
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $access_token,
        ];
        $url = $this->base_url . '/' . $path;
        
        try {
            $response = $client->get($url, [
                'headers' => $headers,
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            $this->log($statusCode,  'GET', $url, null, json_encode($responseBody, JSON_PRETTY_PRINT));
            return [$statusCode, $responseBody];
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $responseBody = json_decode($e->getResponse()->getBody()->getContents(), true);

            $this->log($statusCode, 'GET', $url, null, json_encode($responseBody, JSON_PRETTY_PRINT));
            return [$statusCode, $responseBody];
        }
    }

    public function log($id, $action, $url, $payload, $response)
    {
        
        $status = new SatusehatLog();
        $status->response_code = strval($id);
        $status->action = $action;
        $status->url = $url;
        $status->payload = $payload;
        $status->response = $response;
        $status->user_id = Yii::$app->user->identity->id;

        try {
            $status->save();
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
        }
    }
    public function respondError($message)
    {
        $statusCode = $message['statusCode'];
        $res = $message['res'];
        return [$statusCode, $res];
    }
}
