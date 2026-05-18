<?php

include('../classes/registrar.php');

$admin = new registrar();

if (isset($_POST['register'])) {

    $curriculumId = trim($_POST['curriculumId'] ?? '');
    $subjectId = trim($_POST['subjectId'] ?? '');

    // VALIDATIONS
    if ($curriculumId == '' && $subjectId) {

        $response = array(
            'error' => "All fields are empty!"
        );

    } else if ($curriculumId == '') {

        $response = array(
            'error' => "Please select a curriculum!"
        );

    } else if ($subjectId == '') {

        $response = array(
            'error' => "Please select a subject!"
        );

    } else {

        $insert = $admin->addSubCurriculum($curriculumId, $subjectId);

        if ($insert === 1) {

            $response = array(
                'success' => "Subject Curriculum created successfully!"
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