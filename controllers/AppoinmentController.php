<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Post;
use app\models\Appointment;
use app\models\ServiceCenter;

class AppoinmentController extends Controller
{
    public function book(Request $request)
    {
        $appointment = new Appointment();

        $cus_id = Application::$app->session->get('customer');
        if (!$cus_id) {
            Application::$app->session->setFlash('error', 'Please log in to book an appointment.');
            Application::$app->response->redirect('/customer-login');
            return;
        }



        if ($request->isPost()) {
            $appointment->loadData($request->getBody());
            $appointment->service_center_id = $request->getBody()['service_center_id'];
            $appointment->customer_id = $cus_id;

            if ($appointment->isSlotAvailable()) {
                if ($appointment->save() && $appointment->validate()) {
                    Application::$app->session->setFlash('success', 'Appointment booked successfully.');
                    Application::$app->response->redirect('/customer-dashboard');
                } else {
                    Application::$app->session->setFlash('error', 'Failed to book appointment.');
                }
            } else {
                Application::$app->session->setFlash('error', 'Selected slot is not available. Please choose another time.');
                Application::$app->response->redirect('/customer-service-centers');
            }

        }
        // $this->setLayout('auth');
        // return $this->render('appointment/book-appointment', [
        //     'model' => $appointment
        // ]);
    }

    //function to load the appointment details for the customers 
    public function loadAppointmentDetails()
    {
        $cus_id = Application::$app->session->get('customer');

        if (!$cus_id) {
            Application::$app->session->setFlash('error', 'Please log in to view your appointments.');
            Application::$app->response->redirect('/customer-login');
            return;
        }

        $appointment = new Appointment();
        $appointments = $appointment->loadAppointmentsForCustomer($cus_id);

        $this->setLayout('auth');
        return $this->render('/customer/components/appointment-details', [
            'appointments' => $appointments  // this should always be passed, even if empty
        ]);
    }

    //function to load the appointment details for the service centers
    public function loadAppointmentDetailsForServiceCenter()
    {
        $ser_cen_id = Application::$app->session->get('serviceCenter');
        if (!$ser_cen_id) {
            Application::$app->session->setFlash('error', 'Please log in to view your appointments.');
            Application::$app->response->redirect('/service-centre-login');
            return;
        }
        $appointment = new Appointment();
        $appointments = $appointment->loadAppointmentsForServiceCenter($ser_cen_id);

        $this->setLayout('auth');
        return $this->render('/service-centre/service-centre-dashboard', [
            'appointments' => $appointments
        ]);
    }

    //function to controll status of the appointment 
    public function updateAppointmentStatus(Request $request, Response $response)
    {
        $body = $request->getBody();
        $appointmentId = $body['appointment_id'] ?? null;
        $status = $body['status'] ?? null;

        if(!$appointmentId || !$status) {
            Application::$app->session->setFlash('error', 'Invalid appointment Id or status.');
            return;
        }

        $appointment = new Appointment();
        $result = $appointment->changeStatus($appointmentId, $status);

        if($result) {
            Application::$app->session->setFlash('success', 'Appointment status updated successfully.');
            $response->redirect('/service-centre-dashboard');
        } else {
            Application::$app->session->setFlash('error', 'Failed to update appointment status.');
            $response->redirect('/service-centre-dashboard');
        }

    }

    //function to delete the appointment 
    public function deleteAppointment(Request $request, Response $response)
    {
        $body = $request->getBody();
        $appointmentId = $body['appointment_id'] ?? null;

        if(!$appointmentId) {
            Application::$app->session->setFlash('error', 'Invalid appointment Id.');
            return;
        }

        $appointment = new Appointment();
        $result = $appointment->deleteAppointment($appointmentId);
        if($result) {
            Application::$app->session->setFlash('success', 'Appointment deleted successfully.');
            $response->redirect('/service-centre-dashboard');
        } else {
            Application::$app->session->setFlash('error', 'Failed to delete appointment.');
            $response->redirect('/service-centre-dashboard');
        }
    }

    //function to controll fetch appointment dates 
    public function fetchAppointmentDates(Request $request)
    {
        if($request->isPost()) {
            $body = $request->getBody();
            error_log('Body: ' . print_r($body, true));
            $ser_cen_id = $body['service_center_id'] ?? null;

            error_log('Service Center ID: ' . $ser_cen_id);
            $appointment_date = $body['appointment_date'] ?? date('Y-m-d');

            if (!$ser_cen_id || !$appointment_date) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid service center ID or appointment date.']);
                return;
            }

            $appointment = new Appointment();
            $bookedSlots = $appointment->getBookedTimeSlots($ser_cen_id, $appointment_date);
            error_log('Booked Slots: ' . print_r($bookedSlots, true));

            header('Content-Type: application/json');
            echo json_encode($bookedSlots);
            return;
        }   
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed.']);
    }

}

?>