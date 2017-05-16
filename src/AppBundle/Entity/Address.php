<?php
/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 09.05.17
 * Time: 16:04
 */

namespace AppBundle\Entity;

class Address {

    private $id;
    private $city;
    private $postalCode;
    private $country;
    private $street;

    /**
     * Address constructor.
     * @param $id
     * @param $city
     * @param $postalCode
     * @param $country
     * @param $street
     */
    public function __construct($id, $city, $postalCode, $country, $street)
    {
        $this->id = $id;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->country = $country;
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    public function toArray(){
        return [
            'city'=>$this->city,
            'postalcode'=>$this->postalCode,
            'country'=>$this->country,
            'street'=>$this->street
        ];
    }

}