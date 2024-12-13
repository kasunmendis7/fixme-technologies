<?php

namespace app\models;

use app\core\DbModel;

class Chat extends DbModel
{
    public function tableName(): string
    {
        return 'chat_messages';
    }

    public function attributes(): array
    {
        return ['message_id', 'cus_id', 'tech_id', 'message', 'timestamp'];
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

    public function getChatList($tech_id)
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

    public function getChatMessages($cus_id, $tech_id)
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

    public function saveMessage($tech_id, $cus_id, $message)
    {
        $sql = "INSERT INTO chat_messages (tech_id, cus_id, message) VALUES (:tech_id, :cus_id, :message)";
        $stmt = (new Chat)->prepare($sql);
        $stmt->bindValue(':tech_id', $tech_id);
        $stmt->bindValue(':cus_id', $cus_id);
        $stmt->bindValue(':message', $message);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }
}
