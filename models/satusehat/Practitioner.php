<?php

namespace app\models\satusehat;

use app\components\OAuth2Client;

class Practitioner extends OAuth2Client
{
    public $practitioner;

    /**
     * Retrieves practitioner details by NIK (unique identifier).
     * @param string $nik
     * @return object|null
     */
    public function getSSNik($nik)
    {
        $path = 'Practitioner?identifier=https://fhir.kemkes.go.id/id/nik|' . $nik;
        [$statusCode, $res] = $this->ss_get($path);
        // [$statusCode, $res] = $this->get_by_nik('Practitioner', $nik);

        if ($statusCode != 200) {
            return null;
        }

        $this->practitioner = !empty($res->entry) ? $res->entry[0]->resource : null;

        return $this->practitioner;
    }

    public function searchIhsByNik($nik)
    {
        $path = 'Practitioner?identifier=https://fhir.kemkes.go.id/id/nik|' . $nik;
        [$statusCode, $res] = $this->ss_get($path);
        
        $ihsNumber = null;
        $errorMessage = null;
        if ($statusCode == 200) {
            foreach ($res['entry'] as $entry) {
                if (isset($entry['resource']['id'])) {
                    $ihsNumber = $entry['resource']['id'];
                }
                if ($ihsNumber !== null) {
                    break;
                }
            }
        }
        if ($ihsNumber == null)
            $errorMessage = 'No NIK tenaga kesehatan tidak valid.';
        return [$ihsNumber, $errorMessage];
    }

    public function getId()
    {
        return $this->practitioner ? $this->practitioner->id : null;
    }

    public function getGender()
    {
        return $this->practitioner ? $this->practitioner->gender : null;
    }

    public function getBirthDate()
    {
        return $this->practitioner ? $this->practitioner->birthDate : null;
    }

    public function getName()
    {
        return $this->practitioner ? $this->practitioner->name[0]->text : null;
    }

    public function getQualificationValue()
    {
        return $this->practitioner ? $this->practitioner->qualification[0]->identifier[0]->value : null;
    }

    public function getAddressLine()
    {
        return $this->practitioner ? $this->practitioner->address[0]->line[0] : null;
    }

    public function getCity()
    {
        return $this->practitioner ? $this->practitioner->address[0]->extension[0]->extension[1]->valueCode : null;
    }

    public function getVillage()
    {
        return $this->practitioner ? $this->practitioner->address[0]->extension[0]->extension[3]->valueCode : null;
    }
}
