<?php

namespace app\models;

use app\core\DbModel;
use app\core\Application;

class TechnicianPaymentMethod extends DbModel
{
    public function tableName(): string
    {
        return 'tech_payment_opt';
    }

    public function primaryKey(): string
    {
        return 'tech_pay_opt_id';
    }

    /**
     * Add a new bank account payment method for a technician
     *
     * @param int $techId Technician ID
     * @param string $lastFour Last four digits of the bank account
     * @param string $bankAccNum Full bank account number
     * @param string $bankAccName Bank account name
     * @param string|null $bankAccBranch Bank branch (optional)
     * @return bool Success status
     */
    public function addPaymentMethod($techId, $lastFour, $bankAccNum, $bankAccName, $bankAccBranch = null)
    {
        $sql = "INSERT INTO tech_payment_opt(tech_id, last_four, bank_acc_num, bank_acc_name, bank_acc_branch) 
                VALUES(:tech_id, :last_four, :bank_acc_num, :bank_acc_name, :bank_acc_branch)";

        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':tech_id', $techId);
        $stmt->bindValue(':last_four', $lastFour);
        $stmt->bindValue(':bank_acc_num', $bankAccNum);
        $stmt->bindValue(':bank_acc_name', $bankAccName);
        $stmt->bindValue(':bank_acc_branch', $bankAccBranch);

        return $stmt->execute();
    }

    /**
     * Get all bank accounts for a specific technician
     *
     * @param int $techId Technician ID
     * @return array Bank accounts
     */
    public function getPaymentMethods($techId)
    {
        $sql = "SELECT * FROM tech_payment_opt WHERE tech_id = :tech_id";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':tech_id', $techId);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Delete a specific bank account
     *
     * @param int $id Bank account ID
     * @param int $techId Technician ID (for security verification)
     * @return bool Success status
     */
    public function deletePaymentMethod($id, $techId)
    {
        $sql = "DELETE FROM tech_payment_opt WHERE tech_pay_opt_id = :id AND tech_id = :tech_id";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':tech_id', $techId);

        return $stmt->execute();
    }

    /**
     * Check if a bank account exists
     *
     * @param int $id Bank account ID
     * @param int $techId Technician ID
     * @return bool Whether the bank account exists
     */
    public function paymentMethodExists($id, $techId)
    {
        $sql = "SELECT COUNT(*) FROM tech_payment_opt WHERE tech_pay_opt_id = :id AND tech_id = :tech_id";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':tech_id', $techId);
        $stmt->execute();

        return (int)$stmt->fetchColumn() > 0;
    }

    public function getTechBankDetails($tech_id)
    {
        $sql = "SELECT * FROM tech_payment_opt WHERE tech_id = :tech_id LIMIT 1";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function checkTechnicianPaymentMethod($tech_id)
    {
        $sql = "SELECT COUNT(*) as count FROM tech_payment_opt WHERE tech_id = :tech_id";
        $stmt = Application::$app->db->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['count'];

    }

    /**
     * Rules for validation
     */
    public function rules(): array
    {
        return [
            'tech_id' => [self::RULE_REQUIRED],
            'last_four' => [self::RULE_REQUIRED],
            'bank_acc_num' => [self::RULE_REQUIRED],
            'bank_acc_name' => [self::RULE_REQUIRED],
            // bank_acc_branch is optional
        ];
    }

    public function updateRules(): array
    {
        return $this->rules();
    }

    public function attributes(): array
    {
        return [
            'tech_id',
            'last_four',
            'bank_acc_num',
            'bank_acc_name',
            'bank_acc_branch',
        ];
    }
}