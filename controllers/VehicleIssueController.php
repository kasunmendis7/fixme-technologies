<?php

namespace app\controllers;

use app\core\Controller;
use app\models\VehicleIssue;
use app\core\middlewares\RoleMiddleware;

class VehicleIssueController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new RoleMiddleware(['customer', 'technician']));
    }

    public function getVehicleIssues($vehicle_id)
    {
        $vehicle_id = intval($vehicle_id[0]);
        return json_encode((new VehicleIssue())->getVehicleIssues($vehicle_id));
    }

}