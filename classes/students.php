<?php
require_once('connection.php');


class Users extends Dbh
{

    //register
    public function register($name, $email, $hashed_password)
    {
        $conn = $this->connect();

        // Check name
        $search_id = $conn->prepare("SELECT name FROM users WHERE name = ?");
        $search_id->bind_param("s", $name);
        $search_id->execute();
        $search_id->store_result();

        if ($search_id->num_rows > 0) {
            return 3;
        }

        // Check email
        $search_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $search_email->bind_param("s", $email);
        $search_email->execute();
        $search_email->store_result();

        if ($search_email->num_rows > 0) {
            return 4;
        }

        $role = "student";
        $status = "pending";

        // INSERT
        $stmt = $conn->prepare("
        INSERT INTO users (name, email, password, role, status) 
        VALUES (?, ?, ?, ?, ?)
    ");

        $stmt->bind_param("sssss", $name, $email, $hashed_password, $role, $status);

        if ($stmt->execute()) {
            return 1;
        } else {
            return 2;
        }
    }

    //login
    public function login($email, $password)
    {
        session_start();

        $conn = $this->connect();

        $stmt = $conn->prepare("
        SELECT id, name, email, password, role, status 
        FROM users 
        WHERE email = ?
    ");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if email exists
        if ($result->num_rows === 0) {
            return 8; // email not found
        }

        $row = $result->fetch_assoc();

        // Verify password
        if (!password_verify($password, $row['password'])) {
            return 9; // wrong password
        }

        // Check status
        if ($row['status'] === 'pending') {
            return 10; // account not approved
        }

        // Set session (FIXED: id instead of s_id)
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        // Role-based redirect
        if ($row['role'] === 'student') {
            return '../public/students/home.php';
        } elseif ($row['role'] === 'registrar') {
            return '../public/registrar/home.php';
        } elseif ($row['role'] === 'admin') {
            return '../public/admin/home.php';
        } else {
            return 11; // unknown role (safety)
        }
    }


}
?>