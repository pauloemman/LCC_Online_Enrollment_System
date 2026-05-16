<?php
include('../classes/admin.php');
$update = new admins();

if (isset($_POST['update_profile'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $editSubCode = trim($_POST['editSubCode']);
    $editSubName = trim($_POST['editSubName']);
    $editLecUnits = trim($_POST['editLecUnits']);
    $editLabUnits = trim($_POST['editLabUnits']);
    $editYearLevel = trim($_POST['editYearLevel']);
    $editSemester = trim($_POST['editSemester']);

    if (
        trim($editSubCode) === '' ||
        trim($editSubName) === '' ||
        trim($editLecUnits) === '' ||
        trim($editLabUnits) === '' ||
        trim($editYearLevel) === '' ||
        trim($editSemester) === ''
    ) {
        echo json_encode(['error' => 'All fields cannot be empty']);
        exit;
    }

    $result = $update->updateSubject($id, $editSubCode, $editSubName, $editLecUnits, $editLabUnits, $editYearLevel, $editSemester);

    if ($result) {
        $response = ['success' => true];
    } else {
        $response = ['error' => "No changes made or invalid subject ID"];
    }

    echo json_encode($response);
    exit;
}
?>