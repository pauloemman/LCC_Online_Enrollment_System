<?php

session_start();

include('../classes/students.php');

$admin = new Users();

if (isset($_POST['register'])) {

    // CHECK LOGIN
    if (!isset($_SESSION['id'])) {

        echo json_encode([
            'error' => 'User not logged in.'
        ]);

        exit;
    }

    $userId = $_SESSION['id'];

    $fname = trim($_POST['fname'] ?? '');
    $mname = trim($_POST['mname'] ?? '');
    $lname = trim($_POST['lname'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $bday = trim($_POST['bday'] ?? '');
    $cNum = trim($_POST['cNum'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $departmentId = trim($_POST['departmentId'] ?? '');
    $courseId = trim($_POST['courseId'] ?? '');
    $curriculumId = trim($_POST['curriculumId'] ?? '');
    $sectionId = trim($_POST['sectionId'] ?? '');

    // VALIDATION
    if (
        $fname == '' ||
        $lname == '' ||
        $gender == '' ||
        $bday == '' ||
        $cNum == '' ||
        $address == '' ||
        $departmentId == '' ||
        $courseId == '' ||
        $curriculumId == '' ||
        $sectionId == ''
    ) {

        $response = array(
            'error' => "Please fill in all required fields."
        );

    } else {

        $insert = $admin->enrolNew(
            $userId,
            $fname,
            $mname,
            $lname,
            $gender,
            $bday,
            $cNum,
            $address,
            $departmentId,
            $courseId,
            $curriculumId,
            $sectionId
        );

        if ($insert === 1) {

            $response = array(
                'success' => "Enrollment submitted successfully."
            );

        } else {

            $response = array(
                'error' => "Database error."
            );
        }

        if ($insert === 5) {

            $response = array(
                'error' => "You are already enrolled."
            );

        }
    }

    echo json_encode($response);

    exit;
}
?>