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
}
?>