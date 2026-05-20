<?php

include('../classes/admin.php');

$admin = new admins();

if (isset($_POST['register'])) {

    $subjectId = trim($_POST['subjectId'] ?? '');
    $prerequisiteSubjectId = trim($_POST['prerequisiteSubjectId'] ?? '');

    // VALIDATIONS
    if ($subjectId == '' && $prerequisiteSubjectId == '') {

        $response = array(
            'error' => "All fields are empty!"
        );

    } else if ($subjectId == '') {

        $response = array(
            'error' => "Subject is empty!"
        );

    } else if ($prerequisiteSubjectId == '') {

        $response = array(
            'error' => "Prerequisite Subject is empty!"
        );

    } else {

        $insert = $admin->createPrerequisite($subjectId, $prerequisiteSubjectId);

        if ($insert === 1) {

            $response = array(
                'success' => "Prerequisite created successfully!"
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