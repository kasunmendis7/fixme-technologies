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

    public function rules(): array
    {
        return [];
    }

    public function updateRules(): array
    {
        return [];
    }

}