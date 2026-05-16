<?php
include('../classes/admin.php');
$admin = new admins();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if ($id <= 0) {
        $response = [
            'error' => 'Invalid Subject ID.'
        ];
    } else {
        $deleted = $admin->deleteSubject($id);

        if ($deleted) {
            $response = [
                'success' => 'Subject has been deleted successfully!'
            ];
        } else {
            $response = [
                'error' => 'Failed to delete Subject. Database error.'
            ];
        }
    }
} else {
    $response = [
        'error' => 'No Subject selected.'
    ];
}

echo json_encode($response);
exit;
?>