<?php

class VehicleTransfer
{
    private $id;
    private $vehicleType;
    private $actions;
    private $data;

    /**
     * @param array $array
     */
    public function setData(array $array) {
        $this->data = $array;
    }

    /**
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getVehicleType() {
        return $this->vehicleType;
    }

    /**
     * @return mixed
     */
    public function getActions() {
        return $this->actions;
    }

    /**
     * @param $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param $vehicleType
     */
    public function setVehicleType($vehicleType) {
        $this->vehicleType = $vehicleType;
    }

    /**
     * @param $actions
     */
    public function setActions($actions) {
        $this->actions = $actions;
    }
}