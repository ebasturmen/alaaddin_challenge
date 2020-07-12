<?php

class User
{
    // Connection
    private $conn;
    // Table
    private $db_table = "users";
    // Columns
    public $id;
    public $name;
    public $surname;
    public $phone;
    public $email;
    public $password;

    /**
     * User constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * GEL ALL USERS
     * @return mixed
     */
    public function getUsers()
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    /**
     * CREATE USER
     * @return bool
     */
    public function createUser()
    {
        $sqlQuery = "INSERT INTO " . $this->db_table . " SET name = :name, surname = :surname, phone = :phone, email = :email, password = :password";
        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * GET SINGLE USER INFO
     */
    public function getSingleUser()
    {
        $sqlQuery = "SELECT *  FROM " . $this->db_table . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($dataRow)) {
            $this->name = $dataRow['name'];
            $this->surname = $dataRow['surname'];
            $this->phone = $dataRow['phone'];
            $this->email = $dataRow['email'];
        }
    }

    /**
     * UPDATE USER WITH ID
     * @return bool
     */
    public function updateUser()
    {
        $sqlQuery = "UPDATE " . $this->db_table . " SET name = :name, surname = :surname, phone = :phone WHERE id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * DELETE USER WITH ID
     * @return bool
     */
    function deleteUser()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

?>