<?php

namespace app\models;

use app\controllers\GeocodingController;
use app\core\Application;
use app\core\DbModel;

class Technician extends DbModel
{

    public string $fname = '';
    public string $lname = '';
    public string $phone_no = '';
    public string $address = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function findById($id)
    {
        $sql = "SELECT * FROM technician WHERE tech_id = :tech_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':tech_id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function tableName(): string
    {
        return 'technician';
    }

    public function primaryKey(): string
    {
        return 'tech_id';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function TechnicianAddressGeocoding()
    {
        $sql = "SELECT address, tech_id FROM technician WHERE tech_id = :tech_id";
        $stmt = self::prepare($sql);
        $primaryKey = Application::$app->session->get('technician');
        $stmt->bindValue(':tech_id', $primaryKey);
        $stmt->execute();

        $technician = $stmt->fetch(\PDO::FETCH_ASSOC);

        $geocoding = new GeocodingController();
        $latLng = $geocoding->getLatLngFromAddress($technician['address']);

        if ($latLng) {
            $sql = "UPDATE technician SET latitude = :lat, longitude = :lng WHERE tech_id = :tech_id";
            $stmt = self::prepare($sql);
            $stmt->bindValue(':lat', $latLng['lat']);
            $stmt->bindValue(':lng', $latLng['lng']);
            $stmt->bindValue(':tech_id', $technician['tech_id']);
            $stmt->execute();
        }
    }

    public function techniciansGeocoding()
    {
        $sql = "SELECT tech_id, fname, lname, latitude, longitude FROM technician WHERE latitude IS NOT NULL AND longitude IS NOT NULL";
        $stmt = self::prepare($sql);
        $stmt->execute();
        $technicians = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        header('Content-type: application/json');
        return json_encode($technicians);
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

    public function updateTechnician()
    {
        $sql = "UPDATE technician SET fname = :fname, lname = :lname, phone_no = :phone_no, address = :address WHERE tech_id = :tech_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':fname', $this->fname);
        $stmt->bindValue(':lname', $this->lname);
        $stmt->bindValue(':phone_no', $this->phone_no);
        $stmt->bindValue(':address', $this->address);
        $stmt->bindValue(':tech_id', Application::$app->technician->{'tech_id'});
        return $stmt->execute();
    }

    public function attributes(): array
    {
        return [
            'fname',
            'lname',
            'phone_no',
            'address',
            'email',
            'password',
        ];
    }
}
