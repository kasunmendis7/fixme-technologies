<?php

namespace app\models;

use app\controllers\GeocodingController;
use app\core\Application;
use app\core\DbModel;

class Customer extends DbModel
{

    public string $fname = '';
    public string $lname = '';
    public string $email = '';
    public string $phone_no = '';
    public string $address = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function tableName(): string
    {
        return 'customer';
    }

    public function primaryKey(): string
    {
        return 'cus_id';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    /* Relative to the currently logged in customer, sort the technicians in ascending order based on the distance from the customer */
    public function getAllTechniciansSortedByDistance()
    {
        /* fetch all technicians from db */
        $sql = "SELECT tech_id, fname, lname, longitude, latitude, profile_picture FROM technician";
        $stmt = self::prepare($sql);
        $stmt->execute();
        $technicians = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        /* fetch the logged in customer */
        $sql = "SELECT latitude, longitude FROM customer WHERE cus_id = :cus_id";
        $stmt = self::prepare($sql);
        $primaryKey = Application::$app->session->get('customer');
        $stmt->bindValue(':cus_id', $primaryKey);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        $customerLat = $data['latitude'];
        $customerLng = $data['longitude'];

        $API_KEY = "AIzaSyBCGNUZAUhEzeW8LeV_j3deW44jsA9hWY0";

        $destinations = array_map(function ($technician) {
            return $technician['latitude'] . ',' . $technician['longitude'];
        }, $technicians);
        $destinationsString = implode('|', $destinations);

        /* Batch distance calculation using the distance matrix API */
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?" .
            "origins={$customerLat},{$customerLng}" .
            "&destinations={$destinationsString}" .
            "&mode=driving&units=metric&key={$API_KEY}";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if ($data['status'] !== 'OK') {
            throw new Exception("Error fetching data from Distance Matrix API: " . $data['status']);
        }

        /* Add distance and duration of travel fields to each technician */
        foreach ($data['rows'][0]['elements'] as $index => $element) {
            if ($element['status'] === 'OK') {
                $technicians[$index]['distance'] = $element['distance']['value'] / 1000; // Distance in km
                $technicians[$index]['duration'] = $element['duration']['value'] / 60; // Duration in minutes
            } else {
                $technicians[$index]['distance'] = null;
                $technicians[$index]['duration'] = null;
            }
        }

        /* sort technicians by distance in ascending order */
        usort($technicians, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        return $technicians;
    }

    public function getAllServiceCentersSortedByDistance()
    {
        /* fetch all service centers from db */
        $sql = "SELECT ser_cen_id, name, longitude, latitude  FROM service_center";
        $stmt = self::prepare($sql);
        $stmt->execute();
        $serviceCenters = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        /* fetch the logged in customer */
        $sql = "SELECT latitude, longitude FROM customer WHERE cus_id = :cus_id";
        $stmt = self::prepare($sql);
        $primaryKey = Application::$app->session->get('customer');
        $stmt->bindValue(':cus_id', $primaryKey);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        $customerLat = $data['latitude'];
        $customerLng = $data['longitude'];

        $API_KEY = "AIzaSyBCGNUZAUhEzeW8LeV_j3deW44jsA9hWY0";

        $destinations = array_map(function ($serviceCenter) {
            return $serviceCenter['latitude'] . ',' . $serviceCenter['longitude'];
        }, $serviceCenters);
        $destinationsString = implode('|', $destinations);

        /* Batch distance calculation using the distance matrix API */
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?" .
            "origins={$customerLat},{$customerLng}" .
            "&destinations={$destinationsString}" .
            "&mode=driving&units=metric&key={$API_KEY}";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if ($data['status'] !== 'OK') {
            throw new Exception("Error fetching data from Distance Matrix API: " . $data['status']);
        }

        /* Add distance and duration of travel fields to each service center */
        foreach ($data['rows'][0]['elements'] as $index => $element) {
            if ($element['status'] === 'OK') {
                $serviceCenters[$index]['distance'] = $element['distance']['value'] / 1000; // Distance in km
                $serviceCenters[$index]['duration'] = $element['duration']['value'] / 60; // Duration in minutes
            } else {
                $serviceCenters[$index]['distance'] = null;
                $serviceCenters[$index]['duration'] = null;
            }
        }

        /* sort service centers by distance in ascending order */
        usort($serviceCenters, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        return $serviceCenters;

    }

    public function customerAddressGeocoding()
    {
        $sql = "SELECT address, cus_id FROM customer WHERE cus_id = :cus_id";
        $stmt = self::prepare($sql);
        $primaryKey = Application::$app->session->get('customer');
        $stmt->bindValue(':cus_id', $primaryKey);
        $stmt->execute();

        $customer = $stmt->fetch(\PDO::FETCH_ASSOC);

        $geocoding = new GeocodingController();
        $latLng = $geocoding->getLatLngFromAddress($customer['address']);

        if ($latLng) {
            $sql = "UPDATE customer SET latitude = :lat, longitude = :lng WHERE cus_id = :cus_id";
            $stmt = self::prepare($sql);
            $stmt->bindValue(':lat', $latLng['lat']);
            $stmt->bindValue(':lng', $latLng['lng']);
            $stmt->bindValue(':cus_id', $customer['cus_id']);
            $stmt->execute();
        }
    }

    public function getCustomerLocation()
    {
        $sql = "SELECT latitude, longitude FROM customer WHERE cus_id = :cus_id";
        $stmt = self::prepare($sql);
        $primaryKey = Application::$app->session->get('customer');
        $stmt->bindValue(':cus_id', $primaryKey);
        $stmt->execute();

        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return json_encode($data);
    }

    public function updateCustomer()
    {
        $sql = "UPDATE customer SET fname = :fname, lname = :lname, phone_no = :phone_no, address = :address WHERE cus_id = :cus_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':fname', $this->fname);
        $stmt->bindValue(':lname', $this->lname);
        $stmt->bindValue(':phone_no', $this->phone_no);
        $stmt->bindValue(':address', $this->address);
        $stmt->bindValue(':cus_id', Application::$app->customer->{'cus_id'});
        return $stmt->execute();
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM customer WHERE cus_id = :cus_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':cus_id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function rules(): array
    {
        return [
            'fname' => [self::RULE_REQUIRED],
            'lname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE,
                'class' => self::class
            ]],
            'phone_no' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10]],
            'address' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function updateRules(): array
    {
        return [
            'fname' => [self::RULE_REQUIRED],
            'lname' => [self::RULE_REQUIRED],
            'phone_no' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10]],
            'address' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array
    {
        return [
            'fname',
            'lname',
            'email',
            'phone_no',
            'address',
            'password',
        ];
    }
}
