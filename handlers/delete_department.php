<?php
include('../classes/admin.php');
$admin = new admins();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if ($id <= 0) {
        $response = [
            'error' => 'Invalid Department ID.'
        ];
    } else {
        $deleted = $admin->deleteDepartment($id);

        if ($deleted) {
            $response = [
                'success' => 'Department has been deleted successfully!'
            ];
        } else {
            $response = [
                'error' => 'Failed to delete Department. Database error.'
            ];
        }
    }
} else {
    $response = [
        'error' => 'No Department selected.'
    ];
}

echo json_encode($response);
exit;
?>