<?php

include('../classes/registrar.php');

$admin = new registrar();

if (isset($_POST['register'])) {

    $applicant = trim($_POST['applicant'] ?? '');
    $fname = trim($_POST['fname'] ?? '');
    $mname = trim($_POST['mname'] ?? '');
    $lname = trim($_POST['lname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $exStatus = trim($_POST['exStatus'] ?? '');

    // VALIDATIONS
    if ($applicant == '' && $fname == '' && $mname == '' && $lname == '' && $email == '' && $exStatus == '') {

        $response = array(
            'error' => "All fields are empty!"
        );

    } else if ($applicant == '') {

        $response = array(
            'error' => "Applicant NO. is empty!"
        );

    } else if ($fname == '') {

        $response = array(
            'error' => "FIrst Name is empty!"
        );

    } else if ($mname == '') {

        $response = array(
            'error' => "Middle Name is empty!"
        );

    } else if ($lname == '') {

        $response = array(
            'error' => "Last Name is empty!"
        );

    } else if ($email == '') {

        $response = array(
            'error' => "email is empty!"
        );

    } else if ($exStatus == '') {

        $response = array(
            'error' => "exam status is empty!"
        );

    } else {

        $insert = $admin->addAccount($applicant, $fname, $mname, $lname, $email, $exStatus);

        if ($insert === 1) {

            $response = array(
                'success' => "Account added successfully!"
            );

        } else {

            $response = array(
                'error' => "Database error."
            );
        }
    }

    echo json_encode($response);

    exit;
}
?>