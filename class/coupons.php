<?php

class Coupons
{
    // Connection
    private $conn;
    // Table
    private $db_table = "discount_codes";
    // Columns
    public $id;
    public $code;
    public $owner_id;
    public $coupon_id;
    public $user_id;

    /**
     * User constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * GEL ALL CODES WHERE OWNER IS NULL
     * @return mixed
     */
    public function getCodes()
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE owner_id IS NULL";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    /**
     * USER TAKE COUPON FOR HIMSELF
     * @return mixed
     */
    public function takeCode()
    {
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->coupon_id = htmlspecialchars(strip_tags($this->coupon_id));
        if ($this->is_exist($this->user_id)) {
            $sqlQuery = "UPDATE " . $this->db_table . " SET owner_id = :user_id, STATUS=1 WHERE id = :coupon_id";
            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":coupon_id", $this->coupon_id);

            if ($stmt->execute()) {
                $this->sendMail($this->user_id);
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    /**
     * SEND COUPON INFO MAIL TO USER
     * @param $user_id
     */
    public function sendMail($user_id)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE owner_id=? LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $user_id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($dataRow)) {
            $coupon_code = $dataRow['code'];
            $sqlQuery = "SELECT * FROM users WHERE id = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($dataRow)) {
                $email = $dataRow['email'];
                $to_email = $email;
                $subject = 'Alaaddin Adworks Challenge - Kupon Kodunuz';
                $message = 'Kupon kodunuz: ' . $coupon_code;
                $headers = 'From: noreply@company.com';
                mail($to_email, $subject, $message, $headers);
            }
        }
    }

    /**
     * CHECKS IF USER TAKE COUPON BEFORE
     * @param $id
     * @return bool
     */
    public function is_exist($id)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE owner_id=? LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($dataRow)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * GET COUPON INFO IF USER HAS COUPON
     */
    public function get_coupon()
    {
        $this->owner_id = htmlspecialchars(strip_tags($this->owner_id));

        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE owner_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->owner_id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($dataRow)) {
            $this->code = $dataRow['code'];
        }
    }
}

?>