<?php
include('../classes/registrar.php');
$update = new registrar();

if (isset($_POST['update_profile'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $editApplicant = trim($_POST['editApplicant']);
    $editFname = trim($_POST['editFname']);
    $editMname = trim($_POST['editMname']);
    $editLname = trim($_POST['editLname']);
    $editEmail = trim($_POST['editEmail']);
    $editExStatus = trim($_POST['editExStatus']);

    if (empty($editApplicant) || empty($editFname) || empty($editMname) || empty($editLname) || empty($editEmail) || empty($editExStatus)) {
        echo json_encode(['error' => 'Fields cannot be empty']);
        exit;
    }

    $result = $update->editAccount($id, $editApplicant, $editFname, $editMname, $editLname, $editEmail, $editExStatus);

    if ($result) {
        $response = ['success' => "Account updated successfully"];
    } else {
        $response = ['error' => "No changes made or invalid account ID"];
    }

    echo json_encode($response);
    exit;
}
?>