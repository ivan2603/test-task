<?php
namespace App\Models;

use Components\Db;
use PDOException;
use PDO;

class UserModel {

    private const ADMIN = 1;
    private const CLIENT = 2;

    /**
     * User register method
     * @param object $userProfile
     * @return string
     */
    public function register(object $userProfile) {
        $message = 'Error';
        $db = Db::getConnection();
        $login = $userProfile->getLogin();
        $firstname = $userProfile->getFirstName();
        $lastname = $userProfile->getLastName();
        $email = $userProfile->getEmail();
        $password = $userProfile->getPassword();
        $sql = 'INSERT INTO users (login, email, firstname, lastname, password) VALUES (?, ?, ?, ?, ?)';
        $result = $db->prepare($sql);
        if ($result->execute([$login, $email, $firstname, $lastname, $password])) {
            $lastInsertedId = $db->lastInsertId();
            $countSql = "SELECT COUNT(*) FROM users";
            $countResult = $db->query($countSql);
            $count = $countResult->fetchColumn();
            if ($count == 1) {
                $updateSql = 'UPDATE users SET role = ? WHERE id = ?';
                $updateStatement = $db->prepare($updateSql);
                try {
                    $updateStatement->execute([self::ADMIN, $lastInsertedId]);
                } catch (PDOException $exception) {
                    $message = "Error: ".$exception->getMessage();
                }
            } else {
                $updateSql = 'UPDATE users SET role = ? WHERE id = ?';
                $updateStatement = $db->prepare($updateSql);
                try {
                    $updateStatement->execute([self::CLIENT, $lastInsertedId]);
                } catch (PDOException $exception) {
                    $message = "Error: ".$exception->getMessage();
                }

            }
            $message = '';
        }
        return $message;
    }

    /**
     * User login method
     * @param $email
     * @return mixed
     */
    public function login($email) {
        $db = Db::getConnection();
        $sql = "SELECT * FROM users WHERE email = ?";
        $result = $db->prepare($sql);
        $result->execute([$email]);

        return $result->fetch(PDO::FETCH_ASSOC);
    }
}