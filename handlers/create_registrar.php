<?php
include('../classes/admin.php');
$admin = new admins();

if (isset($_POST['register'])) {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

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

        $insert = $admin->registerRegistrar($name, $email, $hashed_password);

        if ($insert === 1) {
            $response = array('success' => "Registrar account created successfully!");
        } else if ($insert === 3) {
            $response = array('error' => "Name already exists!");
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