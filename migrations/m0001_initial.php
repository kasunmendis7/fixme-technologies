<?php

class m0001_initial
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL1 = "CREATE TABLE `users` (
                  `tech_id` int NOT NULL AUTO_INCREMENT,
                  `fname` varchar(45) NOT NULL,
                  `lname` varchar(45) NOT NULL,
                  `email` varchar(100) NOT NULL,
                  `password` varchar(255) NOT NULL,
                  `phone_no` varchar(15) NOT NULL,
                  `address` varchar(200) NOT NULL,
                  `profile_picture` varchar(255) DEFAULT NULL,
                  `reg_date` date DEFAULT NULL,
                  `longitude` decimal(10,8) DEFAULT NULL,
                  `latitude` decimal(11,8) DEFAULT NULL,
                  PRIMARY KEY (`tech_id`),
                  UNIQUE KEY `tech_id_UNIQUE` (`tech_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
        $db->pdo->exec($SQL1);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL1 = "DROP TABLE users;";
        $db->pdo->exec($SQL1);
    }
}