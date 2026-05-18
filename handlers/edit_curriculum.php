<?php
include('../classes/registrar.php');
$update = new registrar();

if (isset($_POST['update_profile'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $editCourseId = trim($_POST['editCourseId']);
    $editYearLevel = trim($_POST['editYearLevel']);
    $editSemester = trim($_POST['editSemester']);
    $editSchoolYear = trim($_POST['editSchoolYear']);

    if (empty($editCourseId) || empty($editYearLevel) || empty($editSemester) || empty($editSchoolYear)) {
        echo json_encode(['error' => 'Fields cannot be empty']);
        exit;
    }

    $result = $update->updateCurriculum($id, $editCourseId, $editYearLevel, $editSemester, $editSchoolYear);

    if ($result) {
        $response = ['success' => "Curriculum updated successfully"];
    } else {
        $response = ['error' => "No changes made or invalid curriculum ID"];
    }

    echo json_encode($response);
    exit;
}
?>