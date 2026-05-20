<?php
include('../classes/registrar.php');

$update = new registrar();

if (isset($_POST['approve_enrollment'])) {

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    if (empty($id)) {

        echo json_encode(['error' => 'Invalid enrollment ID']);
        exit;

    }

    $result = $update->approveEnrollment($id);

    if ($result) {

        $response = ['success' => 'Enrollment approved successfully'];

    } else {

        $response = ['error' => 'Failed to approve enrollment'];

    }

    echo json_encode($response);
    exit;
}
?>