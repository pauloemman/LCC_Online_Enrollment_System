<?php
require_once('connection.php');

class admins extends Dbh
{
    //view registrars
    public function viewRegistrars()
    {
        $conn = $this->connect();
        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT name, email 
            FROM users 
            WHERE role = ? 
            ORDER BY id DESC";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $role = "registrar";
        $stmt->bind_param("s", $role);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : null;
    }

    //create registrar account
    public function registerRegistrar($name, $email, $hashed_password)
    {
        $conn = $this->connect();

        // Check name
        $search_name = $conn->prepare("SELECT name FROM users WHERE name = ?");
        $search_name->bind_param("s", $name);
        $search_name->execute();
        $search_name->store_result();

        if ($search_name->num_rows > 0) {
            return 3; // name already exists
        }

        // Check email
        $search_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $search_email->bind_param("s", $email);
        $search_email->execute();
        $search_email->store_result();

        if ($search_email->num_rows > 0) {
            return 4; // email already exists
        }

        $role = "registrar";
        $status = "active";

        // INSERT
        $stmt = $conn->prepare("
        INSERT INTO users (name, email, password, role, status) 
        VALUES (?, ?, ?, ?, ?)
    ");

        $stmt->bind_param("sssss", $name, $email, $hashed_password, $role, $status);

        if ($stmt->execute()) {
            return 1; // success
        } else {
            return 2; // error
        }
    }



}
?>