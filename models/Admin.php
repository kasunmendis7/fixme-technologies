<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class Admin extends DbModel
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
        return 'admin';
    }

    public function primaryKey(): string
    {
        return 'admin_id';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function updateAdmin()
    {
        $sql = "UPDATE admin SET fname = :fname, lname = :lname, phone_no = :phone_no, address = :address WHERE admin_id = :admin_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':fname', $this->fname);
        $stmt->bindValue(':lname', $this->lname);
        $stmt->bindValue(':phone_no', $this->phone_no);
        $stmt->bindValue(':address', $this->address);
        $stmt->bindValue(':admin_id', Application::$app->admin->{'admin_id'});
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

    public static function findAllCustomers()
    {
        $sql = "SELECT cus_id, fname, lname, email, phone_no, address, reg_date FROM customer";
        $statement = (new Admin)->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function findAllTechnicians()
    {
        $sql = "SELECT tech_id, fname, lname, email, phone_no, address, reg_date FROM technician";
        $statement = (new Admin)->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function deleteCustomerById($cus_id)
    {
        $db = Application::$app->db; // Ensure this points to the correct Database instance
        $sql = "DELETE FROM customer WHERE cus_id = :cus_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':cus_id', (int)$cus_id, \PDO::PARAM_INT);
        return $stmt->execute();

    }

    public static function deleteTechnicianById($tech_id)
    {
        $db = Application::$app->db; // Database instance
        $sql = "DELETE FROM technician WHERE tech_id = :tech_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':tech_id', (int)$tech_id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function countTotalTechnicians()
    {
        $sql = "SELECT COUNT(*) as total FROM technician";
        $stmt = self::prepare($sql);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function countTotalCustomers()
    {
        $sql = "SELECT COUNT(*) as total FROM customer";
        $stmt = self::prepare($sql);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function countTotalServiceCenters()
    {
        $sql = "SELECT COUNT(*) as total FROM service_center";
        $stmt = self::prepare($sql);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

}
