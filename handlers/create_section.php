<?php

include('../classes/registrar.php');

$admin = new registrar();

if (isset($_POST['register'])) {

    $courseId = trim($_POST['courseId'] ?? '');
    $section = trim($_POST['section'] ?? '');
    $yearLevel = trim($_POST['yearLevel'] ?? '');
    $semester = trim($_POST['semester'] ?? '');
    $sYear = trim($_POST['sYear'] ?? '');

    // VALIDATIONS
    if ($courseId == '' && $courseId == '' && $yearLevel == '' && $semester == '' && $sYear == '') {

        $response = array(
            'error' => "All fields are empty!"
        );

    } else if ($courseId == '') {

        $response = array(
            'error' => "Please select a course!"
        );

    } else if ($section == '') {

        $response = array(
            'error' => "Please select a section!"
        );

    } else if ($yearLevel == '') {

        $response = array(
            'error' => "Please select a year level!"
        );

    } else if ($semester == '') {

        $response = array(
            'error' => "Please select a semester!"
        );

    } else {

        $insert = $admin->createSection($courseId, $section, $yearLevel, $semester);

        if ($insert === 1) {

            $response = array(
                'success' => "Section created successfully!"
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