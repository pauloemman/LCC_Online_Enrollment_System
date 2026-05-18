<?php
include('../classes/registrar.php');
$update = new registrar();

if (isset($_POST['update_profile'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $editCurriculumId = trim($_POST['editCurriculumId']);
    $editSubjectId = trim($_POST['editSubjectId']);

    if (empty($editCurriculumId) || empty($editSubjectId)) {
        echo json_encode(['error' => 'Fields cannot be empty']);
        exit;
    }

    $result = $update->updateCurriculumSubject($id, $editCurriculumId, $editSubjectId);

    if ($result) {
        $response = ['success' => "Curriculum subject updated successfully"];
    } else {
        $response = ['error' => "No changes made or invalid curriculum subject ID"];
    }

    echo json_encode($response);
    exit;
}
?>