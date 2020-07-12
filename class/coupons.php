<?php
class Coupons{
    // Connection
    private $conn;
    // Table
    private $db_table = "discount_codes";
    // Columns
    public $id;
    public $code;
    public $owner_id;
    public $status;
    public $coupon_id;
    public $user_id;


    /**
     * User constructor.
     * @param $db
     */
    public function __construct($db){
        $this->conn = $db;
    }

    /**
     * GEL ALL CODES WHERE OWNER IS NULL
     * @return mixed
     */
    public function getCodes(){
        $sqlQuery = "SELECT * FROM " . $this->db_table ." WHERE owner_id IS NULL";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    /**
     * USER TAKE COUPON FOR HIMSELF
     * @return mixed
     */
    public function takeCode(){
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->coupon_id=htmlspecialchars(strip_tags($this->coupon_id));
        if ($this->is_exist($this->user_id))
        {
            $sqlQuery = "UPDATE " . $this->db_table ." SET owner_id = :user_id, STATUS=1 WHERE id = :coupon_id";
            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":coupon_id", $this->coupon_id);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
        else
        {
            return false;
        }
    }

    /**
     * CHECKS IF USER TAKE COUPON BEFORE
     * @param $id
     * @return bool
     */
    public function is_exist($id)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table ." WHERE owner_id=? LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($dataRow))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

}
?>