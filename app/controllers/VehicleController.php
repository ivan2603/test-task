<?php
namespace App\Controllers;

use App\Models\VehicleModel;
use App\Models\VehicleTransfer;

class VehicleController extends BaseController
{
    private VehicleModel $vehicle;
    private VehicleTransfer $vehicleTransfer;

    /**
     * VehicleController constructor.
     */
    public function __construct() {
        $this->vehicle = new VehicleModel();
        $this->vehicleTransfer = new VehicleTransfer();
    }

    /**
     * Action list vehicle type
     */
    public function actionList() {
        session_start();
        if (empty($_SESSION['user'])){
            $this->redirect('/');
        }
        $vehicleData = $this->vehicle->list();
        $this->vehicleTransfer->setData($vehicleData);
        $_SESSION['vehicleDataObject'] = $this->vehicleTransfer;
        require_once (ROOT.'/app/views/vehicle/list.php');
    }

    /**
     * Action create vehicle type
     */
    public function actionCreate() {
        $result = '';
        if (isset($_POST) && !empty($_POST)) {
            $type = trim($_POST['type']);
            $result = $this->vehicle->create($type);
        }
        echo $result;
    }

    /**
     * Action edit vehicle type
     * @return string
     */
    public function actionEdit() {
        $result = '';
        if (isset($_POST) && !empty($_POST)) {
            $type = trim($_POST['inputType']);
            $id = $_POST['inputId'];
            $result = $this->vehicle->edit($id, $type);
        }
        return $result;
    }

    /**
     * Action delete vehicle type
     */
    public function actionDelete() {
        $result = '';
        if (isset($_POST) && !empty($_POST)) {
            $id = $_POST['id'];
            $result = $this->vehicle->delete($id);
        }
        echo $result;
    }
}