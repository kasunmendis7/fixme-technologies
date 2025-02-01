<?php

namespace app\models;

use AllowDynamicProperties;
use app\core\DbModel;

class Chat extends DbModel
{
    public function tableName(): string
    {
        return 'chat_messages';
    }

    public function attributes(): array
    {
        return ['message_id', 'cus_id', 'tech_id', 'outgoing_msg_id', 'incoming_msg_id', 'message', 'timestamp'];
    }

    public function primaryKey(): string
    {
        return 'message_id';
    }

    public function rules(): array
    {
        return [

        ];
    }

    public function updateRules(): array
    {
        return [

        ];
    }

    public function getCustomerChatList($tech_id)
    {
        $sql = "
            SELECT c.cus_id, c.fname, c.lname, c.profile_picture,
                   MAX(m.timestamp) AS last_message_time,
                   (SELECT m.message FROM chat_messages m 
                    WHERE m.cus_id = c.cus_id AND m.tech_id = :tech_id
                    ORDER BY m.timestamp DESC LIMIT 1) AS last_message
            FROM customer c
            LEFT JOIN chat_messages m ON c.cus_id = m.cus_id
            WHERE m.tech_id = :tech_id
            GROUP BY c.cus_id;
        ";
        $stmt = (new Chat)->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTechnicianChatList($cus_id)
    {
        $sql = "
            SELECT t.tech_id, t.fname, t.lname, t.profile_picture,
                   MAX(m.timestamp) AS last_message_time,
                   (SELECT m.message FROM chat_messages m 
                    WHERE m.tech_id = t.tech_id AND m.cus_id = :cus_id
                    ORDER BY m.timestamp DESC LIMIT 1) AS last_message
            FROM technician t
            LEFT JOIN chat_messages m ON t.tech_id = m.tech_id
            WHERE m.cus_id = :cus_id
            GROUP BY t.tech_id;
        ";
        $stmt = (new Chat)->prepare($sql);
        $stmt->bindValue(':cus_id', $cus_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function customerChatMessages($cus_id, $tech_id)
    {
        $sql = "
            SELECT * FROM chat_messages 
            WHERE tech_id = :tech_id AND cus_id = :cus_id
            ORDER BY timestamp ASC;
        ";
        $stmt = (new Chat)->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->bindValue(':cus_id', $cus_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function technicianChatMessages($tech_id, $cus_id)
    {
        $sql = "
            SELECT * FROM chat_messages 
            WHERE tech_id = :tech_id AND cus_id = :cus_id
            ORDER BY timestamp ASC;
        ";
        $stmt = (new Chat)->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->bindValue(':cus_id', $cus_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function technicianSaveMessage($tech_id, $cus_id, $message)
    {
        $sql = "INSERT INTO chat_messages (tech_id, cus_id, outgoing_msg_id, incoming_msg_id, message) VALUES (:tech_id, :cus_id, :outgoing_msg_id, :incoming_msg_id, :message)";
        $stmt = (new Chat)->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->bindValue(':cus_id', $cus_id);
        $stmt->bindValue(':outgoing_msg_id', $tech_id);
        $stmt->bindValue(':incoming_msg_id', $cus_id);
        $stmt->bindValue(':message', $message);
        return $stmt->execute();
    }

    public function customerSaveMessage($cus_id, $tech_id, $message)
    {
        $sql = "INSERT INTO chat_messages (tech_id, cus_id, outgoing_msg_id, incoming_msg_id, message) VALUES (:tech_id, :cus_id, :outgoing_msg_id, :incoming_msg_id, :message)";
        $stmt = (new Chat)->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->bindValue(':cus_id', $cus_id);
        $stmt->bindValue(':outgoing_msg_id', $cus_id);
        $stmt->bindValue(':incoming_msg_id', $tech_id);
        $stmt->bindValue(':message', $message);
        return $stmt->execute();
    }

    public function findCustomerById($id)
    {
        $sql = "SELECT * FROM customer WHERE cus_id = :cus_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':cus_id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findTechnicianById($id)
    {
        $sql = "SELECT * FROM technician WHERE tech_id = :tech_id";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':tech_id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
