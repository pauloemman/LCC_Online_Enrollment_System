<?php
include('../classes/students.php');

$students = new Users();

if (isset($_POST['register'])) {

    $applicant_no = trim($_POST['applicant_no']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // VALIDATION
    if ($applicant_no == '' || $name == '' || $email == '' || $password == '') {

        $response = array('error' => "All fields are required!");

    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $response = array('error' => "Invalid email format!");

    } else if (
        strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[0-9]/', $password)
    ) {

        $response = array(
            'error' => "Password must be at least 8 characters long, include 1 uppercase letter and 1 number."
        );

    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert = $students->register(
            $applicant_no,
            $name,
            $email,
            $hashed_password
        );

        if ($insert === 1) {
            $response = array('success' => "Account created successfully!");

        } else if ($insert === 2) {
            $response = array('error' => "Database error.");

        } else if ($insert === 3) {
            $response = array('error' => "Applicant number not found or not qualified.");

        } else if ($insert === 4) {
            $response = array('error' => "Email already exists.");

        } else if ($insert === 5) {
            $response = array('error' => "Applicant already registered.");

        } else {
            $response = array('error' => "Something went wrong.");
        }
    }

    echo json_encode($response);
    exit;
}
?>