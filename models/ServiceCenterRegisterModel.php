<?php

namespace app\models;

use app\controllers\GeocodingController;
use app\core\DbModel;

class ServiceCenterRegisterModel extends DbModel
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
        $sql = "SELECT ser_cen_id, address FROM service_center WHERE latitude IS NULL OR longitude IS NULL";
        $stmt = self::prepare($sql);
        $stmt->execute();

        $service_centres = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $geocoding = new GeocodingController();
        foreach ($service_centres as $service_centre) {
            $latLng = $geocoding->getLatLngFromAddress($service_centre['address']);

            if ($latLng) {
                $sql = "UPDATE service_center SET latitude = :lat, longitude = :lng WHERE ser_cen_id = :ser_cen_id";
                $stmt = self::prepare($sql);
                $stmt->bindValue(':lat', $latLng['lat']);
                $stmt->bindValue(':lng', $latLng['lng']);
                $stmt->bindValue('ser_cen_id', $service_centre['ser_cen_id']);
                $stmt->execute();
            }
        }
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            //            'nic' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 15]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'phone_no' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10]],
            'address' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function updateRules(): array
    {
        return [];
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