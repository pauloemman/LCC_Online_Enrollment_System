<?php
include('../classes/admin.php');
$admin = new admins();

if (isset($_POST['register'])) {

    $depName = trim($_POST['depName'] ?? '');
    $code = trim($_POST['code'] ?? '');

    // VALIDATIONS
    if ($depName == '' && $code == '') {
        $response = array('error' => "All fields are empty!");
    } else if ($depName == '') {
        $response = array('error' => "depName is empty!");
    } else if ($code == '') {
        $response = array('error' => "code is empty!");
    } else {

        $insert = $admin->createDepartment($depName, $code);

        if ($insert === 1) {
            $response = array('success' => "Department created successfully!");
        } else if ($insert === 3) {
            $response = array('error' => "Department name already exists!");
        } else if ($insert === 4) {
            $response = array('error' => "Code already exists!");
        } else {
            $response = array('error' => "Database error.");
        }
    }

    echo json_encode($response);
    exit;
}
?>