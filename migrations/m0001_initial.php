<?php
class m0001_initial
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL1 = "CREATE TABLE `technician` (
                  `tech_id` int(11) NOT NULL,
                  `firstName` varchar(45) DEFAULT NULL,
                  `lastName` varchar(45) DEFAULT NULL,
                  `email` varchar(100) NOT NULL,
                  `password` varchar(255) NOT NULL,
                  `phoneNumber` varchar(15) DEFAULT NULL,
                  `address` varchar(200) NOT NULL,
                  `profile_picture` varchar(255) DEFAULT NULL,
                  `reg_date` datetime DEFAULT current_timestamp(),
                  `longitude` decimal(10,8) DEFAULT NULL,
                  `latitude` decimal(11,8) DEFAULT NULL,
                  `status` int(11) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
        $db->pdo->exec($SQL1);

    }
    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL1 = "DROP TABLE technician;";
        $db->pdo->exec($SQL1);
    }
}