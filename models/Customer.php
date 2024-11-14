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

    public function getAllTechnicians()
    {
        $sql = "SELECT fname, lname, profile_picture FROM technician";
        $stmt = self::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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
