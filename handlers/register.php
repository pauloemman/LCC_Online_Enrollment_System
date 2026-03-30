<?php
include('../classes/students.php');
$students = new Users();

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // VALIDATIONS
    if ($name == '' && $email == '' && $password == '') {
        $response = array('error' => "All fields are empty!");
    } else if ($name == '') {
        $response = array('error' => "Name is empty!");
    } else if ($email == '') {
        $response = array('error' => "Email is empty!");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = array('error' => "Invalid email format!");
    } else if ($password == '') {
        $response = array('error' => "Password is empty!");
    } else if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $response = array(
            'error' => "Password must be at least 8 characters long, include 1 uppercase letter and 1 number."
        );
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert = $students->register($name, $email, $hashed_password);

        if ($insert === 1) {
            $response = array('success' => "Account created successfully!");
        } else if ($insert === 3) {
            $response = array('error' => "ID number already exists!");
        } else if ($insert === 4) {
            $response = array('error' => "Email already exists!");
        } else {
            $response = array('error' => "Database error.");
        }
    }

    echo json_encode($response);
    exit;
}
?>