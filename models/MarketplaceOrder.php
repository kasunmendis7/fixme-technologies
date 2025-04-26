<?php 

namespace app\models;

use app\core\DbModel;
use PDO;

class MarketplaceOrder extends DbModel
{
    public string $order_id = '';
    public float $total_amount = 0.00;
    // public float $commission = 0.00;
    // public float $seller_earnings = 0.00;
    public string $status = 'pending';
    public string $paid_at = '';
    public int $customer_id = 0;
    // public int $service_center_id = 0;


    public function tableName(): string
    {
        return 'marketplace_orders';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['order_id', 'customer_id', 'total_amount', 'status', 'paid_at'];
    }

    //create a save function
    public function InsertForTable()
    {
        $tableName = $this->tableName();
        $sql = "INSERT INTO $tableName (order_id, customer_id, total_amount, status, paid_at) VALUES (:order_id, :customer_id, :total_amount, :status, :paid_at)";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':order_id', $this->order_id);
        $stmt->bindValue(':customer_id', $this->customer_id);
        $stmt->bindValue(':total_amount', $this->total_amount);
        $stmt->bindValue(':status', $this->status);
        $stmt->bindValue(':paid_at', $this->paid_at);

        $result = $stmt->execute();

        if (!$result) {
            error_log("Insert failed: " . print_r($stmt->errorInfo(), true));
        }
    
        return $result;
    }

    //list order details occording to the customer id 
    public function listOrderDetails($order_id)
    {
        $sql = "SELECT * FROM marketplace_orders WHERE order_id = :order_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':order_id', $order_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } 

    //function to list order details according to the customer id 
    public function listOrderDetailsByCustomer($cus_id)
    {
        $sql = "SELECT * FROM marketplace_orders WHERE customer_id = :customer_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':customer_id', $cus_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //function to list order id s according to the customer id
    public function listOrderIdByCustomer($cus_id)
    {
        $sql = "SELECT order_id FROM marketplace_orders WHERE customer_id = :customer_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':customer_id', $cus_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function rules(): array
    {
        return [
            'order_id' => [self::RULE_REQUIRED],
            'customer_id' => [self::RULE_REQUIRED],
            'total_amount' => [self::RULE_REQUIRED],
            'status' => [self::RULE_REQUIRED],
        ];
    }

    public function updateRules(): array
    {
        return [];
    }

    

}