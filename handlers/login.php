<?php
include('../classes/students.php');
$clients = new Users();

if (isset($_POST['login'])) {

    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

    // Validations
    if ($login_email == '' && $login_password == '') {
        $response = array('error' => "Email and Password are empty!");
    } else if ($login_email == '') {
        $response = array('error' => "Email is empty!");
    } else if ($login_password == '') {
        $response = array('error' => "Password is empty!");
    } else if (strlen($login_password) < 8 || !preg_match('/[A-Z]/', $login_password) || !preg_match('/[0-9]/', $login_password)) {
        $response = array('error' => "Password must be at least 8 characters long, include at least one uppercase letter and one number.");
    } else {
        $login = $clients->login($login_email, $login_password);

        if ($login == 9) {
            $response = array('error' => "Incorrect password!");
        } else if ($login === 8) {
            $response = array('error' => "User not found!");
        } else if ($login === 10) {
            $response = array('error' => "Account is still pending approval!");
        } else {
            $response = array('redirect' => $login);
        }
    }

    echo json_encode($response);
    exit;
}
?>