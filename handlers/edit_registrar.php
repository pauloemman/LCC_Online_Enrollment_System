<?php

include('../classes/admin.php');

$update = new admins();

if (isset($_POST['update_profile'])) {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // VALIDATIONS
    if ($name == '' && $email == '') {

        $response = array(
            'error' => "Name and email are empty!"
        );

    } else if ($name == '') {

        $response = array(
            'error' => "Name is empty!"
        );

    } else if ($email == '') {

        $response = array(
            'error' => "Email is empty!"
        );

    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $response = array(
            'error' => "Invalid email format!"
        );

    }

    // PASSWORD VALIDATION ONLY IF PASSWORD IS ENTERED
    else if (
        $password != '' &&
        (
            strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[0-9]/', $password)
        )
    ) {

        $response = array(
            'error' => "Password must be at least 8 characters long, include 1 uppercase letter and 1 number."
        );

    } else {

        // HASH PASSWORD ONLY IF NOT EMPTY
        $hashed_password = ($password != '')
            ? password_hash($password, PASSWORD_DEFAULT)
            : null;

        $result = $update->updateRegistrar(
            $name,
            $email,
            $hashed_password
        );

        if ($result) {

            $response = array(
                'success' => "Registrar updated successfully!"
            );

        } else {

            $response = array(
                'error' => "An error occurred while updating."
            );

        }
    }

    echo json_encode($response);
    exit;
}
?>