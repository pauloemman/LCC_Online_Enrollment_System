<?php
include('../classes/admin.php');
$update = new admins();

if (isset($_POST['update_profile'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $editCouName = trim($_POST['editCouName']);
    $editCouCode = trim($_POST['editCouCode']);

    if (empty($editCouName) || empty($editCouCode)) {
        echo json_encode(['error' => 'Course and code cannot be empty']);
        exit;
    }

    $result = $update->updateCourse($id, $editCouName, $editCouCode);

    if ($result) {
        $response = ['success' => "Course updated successfully"];
    } else {
        $response = ['error' => "No changes made or invalid course ID"];
    }

    echo json_encode($response);
    exit;
}
?>