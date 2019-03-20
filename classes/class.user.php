<?php

require_once('dbconfig.php');

class USER
{	

    private $conn;

    public function __construct() {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function doLogin($uname, $umail, $upass) {
        try {
            $stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass FROM users WHERE user_name=:uname OR user_email=:umail ");
            $stmt->execute(array(':uname' => $uname, ':umail' => $umail));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 1) {
                if (password_verify($upass, $userRow['user_pass'])) {
                    $_SESSION['user_session'] = $userRow['user_id'];
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function is_loggedin() {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    public function redirect($url) {
        header("Location: $url");
    }

    public function doLogout() {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }

    public function RegID($type) {
        /* Random unique ID */
        $unique_id = strtoupper(uniqid());
        $final_uniq_id_1 = substr($unique_id, 2, 2);
        $final_uniq_id_2 = substr($unique_id, 4, 9);
        $registration_number = $final_uniq_id_1 . $type . $final_uniq_id_2;

        return $registration_number;
    }

// SMS Varification Code
    public function VerifyCode() {
        /* Random unique ID */
        $unique_id = strtoupper(uniqid());
        $final_uniq_id_1 = substr($unique_id, 4, 6);
        $VerifyCode = $final_uniq_id_1;

        return $VerifyCode;
    }

    // User View
    public function ViewData($id,$type) {
        try {
            $stmt = $this->conn->prepare("SELECT registration.`reg_id`, registration.`name`, registration.`address`, registration.`email`, registration.`id_type`, registration.`id_number`, registration.`mobile`, profession_category.profession, registration.gate FROM `profession_category` LEFT JOIN registration ON registration.id = profession_category.reg_table_id WHERE profession_category.profession = '$id' AND registration.vip_type = '$type'");

            $stmt->execute();
            $UserData = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $UserData;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }    


    public function ViewProssion($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `ticket_category` WHERE `id` = $id");
        //var_dump($stmt);

            $stmt->execute();
            $ViewProssion = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $ViewProssion;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function lastInsertedID() {
        $stmt = $this->conn->lastInsertId();
        return $stmt;
    }


}
?>