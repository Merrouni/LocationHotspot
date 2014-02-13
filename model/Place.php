<?php

/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 12/02/14
 * Time: 16:04
 */
class Place
{
    private $id;
    private $internet;
    private $coffee;
    private $plugs;
    private $openTime;
    private $closeTime;
    private $address;
    private $latitude;
    private $longitude;

    public function __construct($internet, $coffee, $plugs, $openTime, $closeTime, $address)
    {
        $this->internet = $internet;
        $this->coffee = $coffee;
        $this->plugs = $plugs;
        $this->openTime = $openTime;
        $this->closeTime = $closeTime;
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getCloseTime()
    {
        return $this->closeTime;
    }

    /**
     * @return mixed
     */
    public function getCoffee()
    {
        return $this->coffee;
    }

    /**
     * @return mixed
     */
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * @return mixed
     */
    public function getOpenTime()
    {
        return $this->openTime;
    }

    /**
     * @return mixed
     */
    public function getPlugs()
    {
        return $this->plugs;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getLatitude()
    {
        if (null === $this->latitude) {
            $this->getCoordinates();
        }
        return $this->latitude;
    }

    public function getLongitude()
    {
        if (null === $this->longitude) {
            $this->getCoordinates();
        }
        return $this->longitude;
    }

    private function getCoordinates()
    {
        //TODO:calculate the coordinates from the address ans update the object in database
    }
} 