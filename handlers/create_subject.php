<?php

include('../classes/admin.php');

$admin = new admins();

if (isset($_POST['register'])) {

    $courseId = trim($_POST['courseId'] ?? '');
    $subCode = trim($_POST['subCode'] ?? '');
    $subName = trim($_POST['subName'] ?? '');
    $lecUnits = trim($_POST['lecUnits'] ?? '');
    $labUnits = trim($_POST['labUnits'] ?? '');
    $yearLevel = trim($_POST['yearLevel'] ?? '');
    $semester = trim($_POST['semester'] ?? '');

    // VALIDATIONS
    if ($courseId == '' && $subCode == '' && $subName == '' && $lecUnits == '' && $labUnits == '' && $yearLevel == '' && $semester == '') {

        $response = array(
            'error' => "All fields are empty!"
        );

    } else if ($courseId == '') {

        $response = array(
            'error' => "Please select a course!"
        );

    } else if ($subCode == '') {

        $response = array(
            'error' => "Subject Code is empty!"
        );

    } else if ($subName == '') {

        $response = array(
            'error' => "Subject Name is empty!"
        );

    } else if ($lecUnits == '') {

        $response = array(
            'error' => "Lecture Units is empty!"
        );

    } else if ($labUnits == '') {

        $response = array(
            'error' => "Lab Units is empty!"
        );

    } else if ($yearLevel == '') {

        $response = array(
            'error' => "Year Level is empty!"
        );

    } else if ($semester == '') {

        $response = array(
            'error' => "Semester is empty!"
        );

    } else {

        $insert = $admin->createSubject($courseId, $subCode, $subName, $lecUnits, $labUnits, $yearLevel, $semester);

        if ($insert === 1) {

            $response = array(
                'success' => "Subject created successfully!"
            );

        } else if ($insert === 3) {

            $response = array(
                'error' => "Subject name already exists!"
            );

        } else if ($insert === 4) {

            $response = array(
                'error' => "Subject Code already exists!"
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