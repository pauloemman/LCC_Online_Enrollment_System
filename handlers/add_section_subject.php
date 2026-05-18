<?php

include('../classes/registrar.php');

$admin = new registrar();

if (isset($_POST['register'])) {

    $sectionId = trim($_POST['sectionId'] ?? '');
    $subjectId = trim($_POST['subjectId'] ?? '');
    $schedule = trim($_POST['schedule'] ?? '');
    $room = trim($_POST['room'] ?? '');
    $instructor = trim($_POST['instructor'] ?? '');

    // VALIDATIONS
    if ($sectionId == '' && $subjectId && $schedule && $room && $instructor) {

        $response = array(
            'error' => "All fields are empty!"
        );

    } else if ($sectionId == '') {

        $response = array(
            'error' => "Please select a section!"
        );

    } else if ($subjectId == '') {

        $response = array(
            'error' => "Please select a subject!"
        );

    } else if ($schedule == '') {

        $response = array(
            'error' => "Schedule is empty!"
        );

    } else if ($room == '') {

        $response = array(
            'error' => "Room is empty!"
        );

    } else if ($instructor == '') {

        $response = array(
            'error' => "Instructor id empty!"
        );

    } else {

        $insert = $admin->addSubjectSection($sectionId, $subjectId, $schedule, $room, $instructor);

        if ($insert === 1) {

            $response = array(
                'success' => "Subject Section created successfully!"
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