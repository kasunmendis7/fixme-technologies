<?php
namespace app\models;
use app\core\Model;
class TechnicianModel extends Model
{
    public string $fname = '';
    public string $lname = '';
    public string $nic = '';
    public string $phone_no = '';
    public string $address = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
    public function signUp(){
        echo "Creating new technician account";
    }
    public function rules():array{
        return[
            'fname' => [self::RULE_REQUIRED],
            'lname' => [self::RULE_REQUIRED],
            'nic' => [self::RULE_REQUIRED],
            'phone_no' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL], // Unique email property need to be added
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>8], [self::RULE_MAX, 'max'=>24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match'=>'password']],
        ];
    }
}