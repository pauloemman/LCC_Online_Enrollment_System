<?php
include('../classes/registrar.php');
$update = new registrar();

if (isset($_POST['update_profile'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $editCourseId = trim($_POST['editCourseId']);
    $editSection = trim($_POST['editSection']);
    $editYearLevel = trim($_POST['editYearLevel']);
    $editSemester = trim($_POST['editSemester']);

    if (empty($editCourseId) || empty($editSection) || empty($editYearLevel) || empty($editSemester)) {
        echo json_encode(['error' => 'Fields cannot be empty']);
        exit;
    }

    $result = $update->updateSection($id, $editCourseId, $editSection, $editYearLevel, $editSemester);

    if ($result) {
        $response = ['success' => "Section updated successfully"];
    } else {
        $response = ['error' => "No changes made or invalid section ID"];
    }

    echo json_encode($response);
    exit;
}
?>