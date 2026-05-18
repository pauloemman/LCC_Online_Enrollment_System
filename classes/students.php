<?php
require_once('connection.php');


class Users extends Dbh
{

    public function register($applicant_no, $name, $email, $hashed_password)
    {
        $conn = $this->connect();

        // CHECK IF APPLICANT EXISTS AND PASSED
        $check_exam = $conn->prepare("
        SELECT id 
        FROM exam_passers
        WHERE applicant_no = ?
        AND exam_status = 'Passed'
    ");

        $check_exam->bind_param("s", $applicant_no);
        $check_exam->execute();
        $check_exam->store_result();

        if ($check_exam->num_rows == 0) {
            return 3;
        }

        // CHECK EMAIL IF ALREADY REGISTERED
        $search_email = $conn->prepare("
        SELECT email 
        FROM users 
        WHERE email = ?
    ");

        $search_email->bind_param("s", $email);
        $search_email->execute();
        $search_email->store_result();

        if ($search_email->num_rows > 0) {
            return 4;
        }

        // CHECK IF APPLICANT ALREADY REGISTERED
        $search_applicant = $conn->prepare("
        SELECT id 
        FROM users 
        WHERE applicant_no = ?
    ");

        $search_applicant->bind_param("s", $applicant_no);
        $search_applicant->execute();
        $search_applicant->store_result();

        if ($search_applicant->num_rows > 0) {
            return 5;
        }

        $role = "student";
        $status = "active";

        // INSERT USER
        $stmt = $conn->prepare("
        INSERT INTO users
        (applicant_no, name, email, password, role, status)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

        $stmt->bind_param(
            "ssssss",
            $applicant_no,
            $name,
            $email,
            $hashed_password,
            $role,
            $status
        );

        if ($stmt->execute()) {
            return 1;
        }

        return 2;
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