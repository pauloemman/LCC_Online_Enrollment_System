<?php
include('../classes/registrar.php');
$update = new registrar();

if (isset($_POST['update_profile'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $editSectionId = trim($_POST['editSectionId']);
    $editSubjectId = trim($_POST['editSubjectId']);
    $editSchedule = trim($_POST['editSchedule']);
    $editRoom = trim($_POST['editRoom']);
    $editInstructor = trim($_POST['editInstructor']);

    if (empty($editSectionId) || empty($editSubjectId) || empty($editSchedule) || empty($editRoom) || empty($editInstructor)) {
        echo json_encode(['error' => 'Fields cannot be empty']);
        exit;
    }

    $result = $update->updateSectionSubject($id, $editSectionId, $editSubjectId, $editSchedule, $editRoom, $editInstructor);

    if ($result) {
        $response = ['success' => "Section subject updated successfully"];
    } else {
        $response = ['error' => "No changes made or invalid Section subject ID"];
    }

    echo json_encode($response);
    exit;
}
?>