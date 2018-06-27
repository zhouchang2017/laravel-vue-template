<?php

namespace App\Services\DataType;

class Address extends Base
{
    protected $name;
    protected $addressLine1;
    protected $addressLine2;
    protected $city;
    protected $districtOrCounty;
    protected $stateOrProvinceCode;
    protected $countryCode;
    protected $postalCode;

    public function __construct(array $array = [])
    {
        $this->init($array);
    }

    private function init($array){
        $this->name = $array['name'];
        $this->addressLine1 = $array['addressLine1'];
        $this->addressLine2 = $array['addressLine2'];
        $this->city = $array['city'];
        $this->districtOrCounty = $array['districtOrCounty'];
        $this->stateOrProvinceCode = $array['stateOrProvinceCode'];
        $this->countryCode = $array['countryCode'];
        $this->postalCode = $array['postalCode'];
    }
}