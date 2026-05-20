<?php
include('../classes/admin.php');
$admin = new admins();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if ($id <= 0) {
        $response = [
            'error' => 'Invalid Prerequisite ID.'
        ];
    } else {
        $deleted = $admin->deletePrerequisite($id);

        if ($deleted) {
            $response = [
                'success' => 'Prerequisite has been deleted successfully!'
            ];
        } else {
            $response = [
                'error' => 'Failed to delete Prerequisite. Database error.'
            ];
        }
    }
} else {
    $response = [
        'error' => 'No Prerequisite selected.'
    ];
}

echo json_encode($response);
exit;
?>