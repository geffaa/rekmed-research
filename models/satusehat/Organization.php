<?php

namespace app\models\satusehat;

use app\components\OAuth2Client;
use yii;

class Organization extends OAuth2Client
{
    private $orgType = [
        ['code' => 'dept', 'display' => 'Hospital Department'],
        ['code' => 'prov', 'display' => 'Healthcare Provider'],
    ];

    public $organization = [
        'resourceType' => 'Organization',
        'active' => true,
    ];

    public function addIdentifier($organization_identifier)
    {
        $identifier = [
            'use' => 'official',
            'system' => 'http://sys-ids.kemkes.go.id/organization/' . $this->organization_id,
            'value' => strval($organization_identifier),
        ];

        $this->organization['identifier'][] = $identifier;
    }

    public function setName($organization_name)
    {
        $this->organization['name'] = $organization_name;
    }

    public function setPartOf($partOf = null)
    {
        $this->organization['partOf']['reference'] = 'Organization/' . ($partOf ?: $this->organization_id);
    }

    public function setType($type = 'dept')
    {
        $types = array_column($this->orgType, 'code');
        if (!in_array($type, $types)) {
            return "Invalid type. Types of organizations currently supported : 'prov' | 'dept'";
        }

        $organizationTypeIndex = array_search($type, $types);
        $display = $this->orgType[$organizationTypeIndex]['display'];

        $this->organization['type'] = [
            [
                'coding' => [
                    [
                        'system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                        'code' => $type,
                        'display' => $display,
                    ],
                ],
            ],
        ];
    }

    public function addPhone($phone_number = null)
    {
        $this->organization['telecom'][] = [
            'system' => 'phone',
            'value' => $phone_number ?: Yii::$app->params['PHONE'],
            'use' => 'work',
        ];
    }

    public function addEmail($email = null)
    {
        $this->organization['telecom'][] = [
            'system' => 'email',
            'value' => $email ?: Yii::$app->params['EMAIL'],
            'use' => 'work',
        ];
    }

    public function addUrl($url = null)
    {
        $this->organization['telecom'][] = [
            'system' => 'url',
            'value' => $url ?: Yii::$app->params['WEBSITE'],
            'use' => 'work',
        ];
    }

    public function setAddressLine($address_line)
    {
        $this->organization['address'][] = [
            'use' => 'work',
            'line' => [$address_line]
        ];
    }

    public function addAddress($address_line = null, $postal_code = null, $city_name = null, $village_code = null)
    {
        $this->organization['address'][] = [
            'use' => 'work',
            'type' => 'both',
            'line' => [$address_line ?: Yii::$app->params['ALAMAT']],
            'city' => $city_name ?: Yii::$app->params['KOTA'],
            'postalCode' => $postal_code ?: Yii::$app->params['KODEPOS'],
            'country' => 'ID',
            'extension' => [
                [
                    'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode',
                    'extension' => [
                        [
                            'url' => 'province',
                            'valueCode' => $village_code ? substr(str_replace('.', '', $village_code), 0, 2) : Yii::$app->params['KODE_PROVINSI'],
                        ],
                        [
                            'url' => 'city',
                            'valueCode' => $village_code ? substr(str_replace('.', '', $village_code), 0, 4) : Yii::$app->params['KODE_KABUPATEN'],
                        ],
                        [
                            'url' => 'district',
                            'valueCode' => $village_code ? substr(str_replace('.', '', $village_code), 0, 6) : Yii::$app->params['KODE_KECAMATAN'],
                        ],
                        [
                            'url' => 'village',
                            'valueCode' => $village_code ? substr(str_replace('.', '', $village_code), 0, 10) : Yii::$app->params['KODE_KELURAHAN'],
                        ],
                    ],
                ],
            ],
        ];
    }

    public function json()
    {
        // Basic validations and default settings
        if (!isset($this->organization['identifier'])) {
            return 'Please use organization->addIdentifier($organization_identifier) to pass the data';
        }

        if (!isset($this->organization['name'])) {
            return 'Please use organization->setName($organization_name) to pass the data';
        }

        if (!isset($this->organization['partOf'])) {
            $this->setPartOf();
        }

        if (!isset($this->organization['type'])) {
            $this->setType();
        }

        return json_encode($this->organization, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function post()
    {
        $payload = json_decode($this->json());
        [$statusCode, $res] = $this->ss_post('Organization', $payload);

        $orgId = null;
        $errorMessage = null;
        if ($statusCode == 201) {
            if(isset($res['id'])) {
                $orgId = $res['id'];
            } 
        }
        return [$orgId, $errorMessage];
    }

}
