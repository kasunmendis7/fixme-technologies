<?php 

namespace app\models;
use app\core\DbModel;


class MarketplaceOrderServiceCenter extends DbModel
{
    public string $order_id = '';
    public int $service_center_id = 0;
    public float $sub_total = 0;
    public float $commission = 0;
    public float $seller_earning = 0;

    public function tableName(): string
    {
        return 'marketplace_order_service_centers';
    }

    public function attributes(): array
    {
        return ['order_id', 'service_center_id', 'sub_total', 'commission', 'seller_earning'];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    //create a save function
    public function InsertForTable()
    {
        $tableName = $this->tableName();
        $sql = "INSERT INTO $tableName (order_id, service_center_id, sub_total, commission, seller_earning) VALUES (:order_id, :service_center_id, :sub_total, :commission, :seller_earning)";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':order_id', $this->order_id);
        $stmt->bindValue(':service_center_id', $this->service_center_id);
        $stmt->bindValue(':sub_total', $this->sub_total);
        $stmt->bindValue(':commission', $this->commission);
        $stmt->bindValue(':seller_earning', $this->seller_earning);
        return $stmt->execute();
    }

    public function rules(): array
    {
        return [];
    }

    public function updateRules(): array
    {
        return [];
    }

}