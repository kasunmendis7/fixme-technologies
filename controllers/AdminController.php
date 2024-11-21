<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Admin;
use app\models\Customer;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        // Render the admin dashboard view
        $this->setLayout('auth');
        return $this->render('/admin/admin-dashboard');
    }

    public function customers()
    {
        // Fetch all customers records
        $customers = Admin::findAllCustomers();
        // Render the all the customer in the database
        $this->setLayout('auth');
        return $this->render('/admin/customers', ['customers' => $customers]);

    }

    public function deleteCustomer(Request $request)
    {
        $data = $request->getBody(); // Assuming this already returns an array
        if (isset($data['cus_id'])) {
            $cus_id = $data['cus_id'];

            // Call the model function to delete the customer
            $result = Admin::deleteCustomerById($cus_id);

            if ($result) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete customer']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid customer ID']);
        }
    }

}
