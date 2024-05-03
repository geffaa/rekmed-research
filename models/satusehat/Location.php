<?php

namespace app\models\satusehat;

use app\components\OAuth2Client;
use yii;

class Location extends OAuth2Client
{
    public $location = [
        'resourceType' => 'Location',
        'status' => 'active',
        'mode' => 'instance',
    ];

    public function addIdentifier($location_identifier)
    {
        $identifier = [
            'system' => 'http://sys-ids.kemkes.go.id/location/' . $this->organization_id,
            'value' => strval($location_identifier),
        ];

        $this->location['identifier'][] = $identifier;
    }

    public function setName($location_name, $location_description = null)
    {
        $this->location['name'] = $location_name;
        $this->location['description'] = $location_description ?: $location_name;
    }

    public function setStatus($status = 'active')
    {
        $this->location['status'] = $status ?: 'active';
    }

    public function setOperationalStatus($operational_status = 'U')
    {
        $operational_status = $operational_status ?: 'U';

        $display = [
            'U' => 'Unoccupied',
            'O' => 'Occupied',
            'C' => 'Closed',
            'H' => 'Housekeeping',
            'I' => 'Isolated',
            'K' => 'Contaminated',
        ];

        $this->location['operationalStatus'] = [
            'system' => 'http://terminology.hl7.org/CodeSystem/v2-0116',
            'code' => $operational_status,
            'display' => $display[$operational_status],
        ];
    }

    public function addPhone($phone_number = null)
    {
        $this->location['telecom'][] = [
            'system' => 'phone',
            'value' => $phone_number ?: Yii::$app->params['PHONE'],
            'use' => 'work',
        ];
    }

    public function addEmail($email = null)
    {
        $this->location['telecom'][] = [
            'system' => 'email',
            'value' => $email ?: Yii::$app->params['EMAIL'],
            'use' => 'work',
        ];
    }

    public function addUrl($url = null)
    {
        $this->location['telecom'][] = [
            'system' => 'url',
            'value' => $url ?: Yii::$app->params['WEBSITE'],
            'use' => 'work',
        ];
    }

    public function setAddressLine($address_line)
    {
        $this->location['address'] = [
            'use' => 'work',
            'line' => [$address_line]
        ];
    }

    public function setAddress($address_line = null, $postal_code = null, $city_name = null, $village_code = null)
    {
        $this->location['address'] = [
            'use' => 'work',
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
                            'valueCode' => $village_code ? substr(str_replace('.', '', $village_code), 0, 8) : Yii::$app->params['KODE_KELURAHAN'],
                        ],
                    ],
                ],
            ],
        ];
    }

    public function addPhysicalType($physical_type = null)
    {
        $code = $physical_type ?: 'ro';
        $display = [
            'bu' => 'Building',
            'wi' => 'Wing',
            'co' => 'Corridor',
            'ro' => 'Room',
            've' => 'Vehicle',
            'ho' => 'House',
            'ca' => 'Cabinet',
            'rd' => 'Road',
            'area' => 'Area',
        ];

        $this->location['physicalType']['coding'][] = [
            'system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
            'code' => $code,
            'display' => $display[$code],
        ];
    }

    public function addPosition($latitude = null, $longitude = null)
    {
        $this->location['position'] = [
            'latitude' => $latitude ?: Yii::$app->params['LATITUDE'],
            'longitude' => $longitude ?: Yii::$app->params['LONGITUDE'],
        ];
    }

    public function setManagingOrganization($managing_organization = null)
    {
        $this->location['managingOrganization']['reference'] = 'Organization/' . ($managing_organization ?: $this->organization_id);
    }

    public function setPartOf($part_of = null)
    {
        $this->location['partOf']['reference'] = 'Location/' . $part_of;
    }

    public function json()
    {
        // Add necessary defaults or checks
        if (!isset($this->location['physicalType'])) {
            $this->addPhysicalType();
        }

        if (!isset($this->location['name'])) {
            return 'Please use location->setName($location_name) to pass the data';
        }

        if (!isset($this->location['identifier'])) {
            return 'Please use location->addIdentifier($location_identifier) to pass the data';
        }

        return json_encode($this->location, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
    public function post()
    {
        $payload = json_decode($this->json());
        [$statusCode, $res] = $this->ss_post('Location', $payload);

        $locationId = null;
        $errorMessage = null;
        if ($statusCode == 201) {
            if(isset($res['id'])) {
                $locationId = $res['id'];
            } 
        }
        return [$locationId, $errorMessage];
    }
}
