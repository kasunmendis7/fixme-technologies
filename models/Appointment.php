<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class Appointment extends DbModel
{
    public int $customer_id;
    public int $service_center_id;
    public string $vehicle_details = '';
    public string $appointment_date = '';
    public string $appointment_time = '';
    public string $status = 'Pending';
    public string $otp = '';

    public function tableName(): string
    {
        return 'appointments';
    }

    public function primaryKey(): string
    {
        return 'appointment_id';
    }

    public function updateRules(): array
    {
        return [
            'vehicle_details' => [self::RULE_REQUIRED],
            'appointment_date' => [self::RULE_REQUIRED],
            'appointment_time' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array
    {
        return ['customer_id', 'service_center_id', 'vehicle_details', 'appointment_date', 'appointment_time', 'status', 'otp'];
    }

    public function rules(): array
    {
        return [
            'vehicle_info' => [self::RULE_REQUIRED],
            'appointment_date' => [self::RULE_REQUIRED],
            'appointment_time' => [self::RULE_REQUIRED],
        ];
    }

    //check if the appointment slot is available

    public function isSlotAvailable()
    {
        $sql = "SELECT * FROM appointments 
            WHERE service_center_id = :sc_id 
            AND appointment_date = :date 
            AND (
                TIME(appointment_time) BETWEEN SUBTIME(:time, '00:30:00') AND ADDTIME(:time, '00:30:00')
            )";

        $stmt = self::prepare($sql);
        $stmt->bindValue(':sc_id', $this->service_center_id);
        $stmt->bindValue(':date', $this->appointment_date);
        $stmt->bindValue(':time', $this->appointment_time);
        $stmt->execute();

        return $stmt->rowCount() === 0;
    }


    //to load appointment data for the customer
    public function loadAppointmentsForCustomer($customer_id)
    {
        $sql = "SELECT a.*, s.name AS service_center_name, s.address AS service_center_address, s.phone_no AS service_center_phone_no
                FROM appointments a
                JOIN service_center s ON a.service_center_id = s.ser_cen_id
                WHERE a.customer_id = :customer_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':customer_id', $customer_id);
        $stmt->execute();
        $appointments = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $appointments;
    }

    //to load appointment data for the service centers 
    public function loadAppointmentsForServiceCenter($service_center_id)
    {
        $sql = "SELECT a.*, c.fname AS customer_fname, c.lname AS customer_lname, c.phone_no AS customer_phone_no 
                FROM appointments a
                JOIN customer c ON a.customer_id = c.cus_id
                WHERE a.service_center_id = :service_center_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':service_center_id', $service_center_id);
        $stmt->execute();
        $appointments = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $appointments;
    }

    //function to change the status of the appointment 
    public function changeStatus($appointment_id, $status)
    {
        $sql = "UPDATE appointments SET status = :status WHERE appointment_id = :appointment_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':appointment_id', $appointment_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //function to get booked time slots
    public function getBookedTimeSlots($service_center_id, $appointment_date)
    {
        $sql = "SELECT appointment_time FROM appointments
                WHERE service_center_id = :service_center_id
                AND appointment_date = :appointment_date";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':service_center_id', $service_center_id);
        $stmt->bindValue(':appointment_date', $appointment_date);
        $stmt->execute();
        $appointment_date = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $appointment_date;
    }

    //function to delete the appointment
    public function deleteAppointment($appointment_id)
    {
        $sql = "DELETE FROM appointments WHERE appointment_id = :appointment_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':appointment_id', $appointment_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //function to get recent customers that book an appointment 
    public function getRecentCustomers($service_center_id)
    {
        $sql = "SELECT c.fname, c.phone_no, c.profile_picture, a.appointment_date, a.appointment_time, a.appointment_id
                FROM appointments a
                JOIN customer c ON a.customer_id = c.cus_id
                WHERE a.service_center_id = :service_center_id
                ORDER BY a.appointment_date DESC, a.appointment_time DESC
                LIMIT 5";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':service_center_id', $service_center_id);
        $stmt->execute();
        $recentCustomers = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $recentCustomers;
    }


    //function to get total count of completed appointments 
    public function getTotalCompletedAppointments($service_center_id)
    {
        $sql = "SELECT COUNT(*) AS total_completed_appointments
                FROM appointments
                WHERE service_center_id = :service_center_id AND status = 'Confirmed'";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':service_center_id', $service_center_id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total_completed_appointments'];
    }

    //function to get completed appointment detials 
    public function getCompletedAppointmentDetails($service_center_id)
    {
        $sql = "SELECT a.*, c.fname, c.lname, c.phone_no
                FROM appointments a
                JOIN customer c ON a.customer_id = c.cus_id
                WHERE a.service_center_id = :service_center_id AND a.status = 'Confirmed'";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':service_center_id', $service_center_id);
        $stmt->execute();
        $completedAppointments = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $completedAppointments;
    }

    public function getOtpByAppointmentId($appointmentId)
    {
        $statement = self::prepare("SELECT otp FROM appointments WHERE appointment_id = :appointment_id");
        $statement->bindValue(':appointment_id', $appointmentId);
        $statement->execute();

        return $statement->fetchColumn();
    }

    //save function
    public function save()
    {
        $query = "INSERT INTO appointments 
                    (customer_id, service_center_id, vehicle_details, appointment_date, appointment_time, status, otp) 
                  VALUES 
                    (:customer_id, :service_center_id, :vehicle_details, :appointment_date, :appointment_time, :status, :otp)";

        $stmt = self::prepare($query);
        $stmt->bindValue(':customer_id', $this->customer_id);
        $stmt->bindValue(':service_center_id', $this->service_center_id);
        $stmt->bindValue(':vehicle_details', $this->vehicle_details);
        $stmt->bindValue(':appointment_date', $this->appointment_date);
        $stmt->bindValue(':appointment_time', $this->appointment_time);
        $stmt->bindValue(':status', $this->status);
        $stmt->bindValue(':otp', $this->otp);
        $stmt->execute();

        // Check if the appointment was successfully inserted
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validate()
    {
        $this->errors = [];

        if (empty($this->customer_id)) {
            $this->errors[] = "Customer ID is required.";
        }

        if (empty($this->service_center_id)) {
            $this->errors[] = "Service Center ID is required.";
        }

        if (empty($this->vehicle_details)) {
            $this->errors[] = "Vehicle details are required.";
        }

        if (empty($this->appointment_date)) {
            $this->errors[] = "Appointment date is required.";
        }

        if (empty($this->appointment_time)) {
            $this->errors[] = "Appointment time is required.";
        }

        return empty($this->errors);
    }


}

?>