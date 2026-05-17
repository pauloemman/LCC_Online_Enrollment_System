<?php

include('../classes/registrar.php');

$admin = new registrar();

if (isset($_POST['register'])) {

    $courseId = trim($_POST['courseId'] ?? '');
    $yearLevel = trim($_POST['yearLevel'] ?? '');
    $semester = trim($_POST['semester'] ?? '');
    $sYear = trim($_POST['sYear'] ?? '');

    // VALIDATIONS
    if ($courseId == '' && $yearLevel == '' && $semester == '' && $sYear == '') {

        $response = array(
            'error' => "All fields are empty!"
        );

    } else if ($courseId == '') {

        $response = array(
            'error' => "Please select a course!"
        );

    } else if ($yearLevel == '') {

        $response = array(
            'error' => "Please select a year level!"
        );

    } else if ($semester == '') {

        $response = array(
            'error' => "Please select a semester!"
        );

    } else if ($sYear == '') {

        $response = array(
            'error' => "School Year is empty!"
        );

    } else {

        $insert = $admin->createCurriculum($courseId, $yearLevel, $semester, $sYear);

        if ($insert === 1) {

            $response = array(
                'success' => "Curriculum created successfully!"
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