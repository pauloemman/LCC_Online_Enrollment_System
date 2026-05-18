<?php
include('../classes/admin.php');
$update = new admins();

if (isset($_POST['update_profile'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $editSubjectId = trim($_POST['editSubjectId']);
    $editPrerequisiteSubjectId = trim($_POST['editPrerequisiteSubjectId']);

    if (empty($editSubjectId) || empty($editPrerequisiteSubjectId)) {
        echo json_encode(['error' => 'Fields cannot be empty']);
        exit;
    }

    $result = $update->updatePrerequisite($id, $editSubjectId, $editPrerequisiteSubjectId);

    if ($result) {
        $response = ['success' => "Prerequisite updated successfully"];
    } else {
        $response = ['error' => "No changes made or invalid Prerequisite ID"];
    }

    echo json_encode($response);
    exit;
}
?>