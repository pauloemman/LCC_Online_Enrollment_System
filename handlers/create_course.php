<?php

include('../classes/admin.php');

$admin = new admins();

if (isset($_POST['register'])) {

    $departmentId = trim($_POST['departmentId'] ?? '');
    $couName = trim($_POST['couName'] ?? '');
    $couCode = trim($_POST['couCode'] ?? '');

    // VALIDATIONS
    if ($departmentId == '' && $couName == '' && $couCode == '') {

        $response = array(
            'error' => "All fields are empty!"
        );

    } else if ($departmentId == '') {

        $response = array(
            'error' => "Please select a department!"
        );

    } else if ($couName == '') {

        $response = array(
            'error' => "Course Name is empty!"
        );

    } else if ($couCode == '') {

        $response = array(
            'error' => "Code is empty!"
        );

    } else {

        $insert = $admin->createCourse($departmentId, $couName, $couCode);

        if ($insert === 1) {

            $response = array(
                'success' => "Course created successfully!"
            );

        } else if ($insert === 3) {

            $response = array(
                'error' => "Course name already exists!"
            );

        } else if ($insert === 4) {

            $response = array(
                'error' => "Code already exists!"
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