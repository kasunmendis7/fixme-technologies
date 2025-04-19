<?php

namespace app\models;
use app\core\Application;
use app\core\DbModel;

class Notification extends DbModel
{
    public int $user_id;
    public int $service_center_id;
    public string $message = '';
    public bool $is_read = false;

    public function tableName(): string
    {
        return 'notifications';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['customer_id', 'service_center_id', 'message', 'is_read'];
    }

    public function rules(): array
    {
        return [
            'message' => [self::RULE_REQUIRED],
        ];
    }
    public function updateRules(): array
    {
        return [];
    }

    //function to create a notification
    public function createNotification($data)
    {
        $sql = "INSERT INTO notifications (user_id, service_center_id, message)
                VALUES (:customer_id, :service_center_id, :message)";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':customer_id', $data['customer_id']);
        $stmt->bindValue(':service_center_id', $data['service_center_id']);
        $stmt->bindValue(':message', $data['message']);
        $stmt->execute();
        // return $stmt->rowCount() > 0;
    }

    //function to get notifications for user 
    public function getUserNotifications($user_id)
    {
        $sql = "SELECT * FROM notifications WHERE user_id = :user_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //function to get notification for the service center
    public function getServiceCenterNotifications($service_center_id)
    {
        $sql = "SELECT * FROM notifications WHERE service_center_id = :service_center_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':service_center_id', $service_center_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    //function to mark notification as read
    public function markAsRead($notification_id)
    {
        $sql = "UPDATE notifications SET is_read = 1 WHERE id = :id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':id', $notification_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    //function to delete read messages
    public function deleteReadMessagesForServiceCenter($service_center_id)
    {
        $sql = "DELETE FROM notifications WHERE is_read = 1 AND service_center_id = :service_center_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':service_center_id', $service_center_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

}

?>