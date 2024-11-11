<?php

namespace app\models;

use app\core\Application;
use app\core\Model;
use app\models\Customer;

class CustomerLogin extends Model
{

    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function updateRules(): array
    {
        return [];
    }

    public function login()
    {
        $customerModel = new Customer();
        $customer = $customerModel->findOne(['email' => $this->email]);
        if (!$customer) {
            $this->addErrorMessage('email', 'User does not exist with this email');
            return false;
        }

        if (!password_verify($this->password, $customer->password)) {
            $this->addErrorMessage('password', 'Password is incorrect');
            return false;
        }

        show($customer);

        return Application::$app->loginCustomer($customer);
    }
}