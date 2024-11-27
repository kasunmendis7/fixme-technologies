<?php

namespace app\models;

use app\controllers\GeocodingController;
use app\core\Application;
use app\core\DbModel;

class ServiceCenter extends DbModel

{

    public string $name = '';
    //    public string $nic = '';
    public string $email = '';
    public string $phone_no = '';
    public string $address = '';
    public string $service_category = '';
    public string $password = '';
    public string $confirmPassword = '';

    //    public function register()
    //    {
    //        return 'Creating new Service Center';
    //    }

    public function tableName(): string
    {
        return 'service_center';
    }

    public function primaryKey(): string
    {
        return 'ser_cen_id';
    }


    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function serviceCentreAddressGeocoding()
    {
        $sql = "SELECT address, ser_cen_id FROM service_center WHERE ser_cen_id = :ser_cen_id";
        $stmt = self::prepare($sql);
        $primaryKey = Application::$app->session->get('service_center');
        $stmt->bindValue(':ser_cen_id', $primaryKey);
        $stmt->execute();

        $serviceCenter = $stmt->fetch(\PDO::FETCH_ASSOC);

        $geocoding = new GeocodingController();
        $latLng = $geocoding->getLatLngFromAddress($serviceCenter['address']);

        if ($latLng) {
            $sql = "UPDATE service_center SET latitude = :lat, longitude = :lng WHERE ser_cen_id = :ser_cen_id";
            $stmt = self::prepare($sql);
            $stmt->bindValue(':lat', $latLng['lat']);
            $stmt->bindValue(':lng', $latLng['lng']);
            $stmt->bindValue(':ser_cen_id', $serviceCenter['ser_cen_id']);
            $stmt->execute();
        }
    }

    public function serviceCentresGeocoding()
    {
        $sql = "SELECT ser_cen_id, name, latitude, longitude, address FROM service_center WHERE latitude IS NOT NULL AND longitude IS NOT NULL";
        $stmt = self::prepare($sql);
        $stmt->execute();
        $service_centres = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        header('Content-type: application/json');
        return json_encode($service_centres);
    }

    public function updateServiceCenter()
    {
        $sql = "UPDATE service_center SET name = :name, phone_no = :phone_no, address = :address, service_category = :service_category WHERE ser_cen_id = :ser_cen_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':phone_no', $this->phone_no);
        $stmt->bindValue(':address', $this->address);
        $stmt->bindValue(':service_category', $this->service_category);
        $stmt->bindValue(':ser_cen_id', Application::$app->serviceCenter->{'ser_cen_id'});
        return $stmt->execute();
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            //            'nic' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 15]],
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
            'name' => [self::RULE_REQUIRED],
            'phone_no' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10]],
            'address' => [self::RULE_REQUIRED]
        ];
    }

    public function attributes(): array
    {
        return [
            'name',
            //            'nic',
            'phone_no',
            'address',
            'email',
            'password',
            'service_category',
        ];
    }
}
