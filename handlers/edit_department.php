<?php
include('../classes/admin.php');
$update = new admins();

if (isset($_POST['update_profile'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $depName = trim($_POST['depName']);
    $code = trim($_POST['code']);

    if (empty($depName) || empty($code)) {
        echo json_encode(['error' => 'Department and code cannot be empty']);
        exit;
    }

    $result = $update->updateDepartment($id, $depName, $code);

    if ($result) {
        $response = ['success' => "Department updated successfully"];
    } else {
        $response = ['error' => "No changes made or invalid department ID"];
    }

    echo json_encode($response);
    exit;
}
?>