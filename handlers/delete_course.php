<?php
include('../classes/admin.php');
$admin = new admins();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if ($id <= 0) {
        $response = [
            'error' => 'Invalid Course ID.'
        ];
    } else {
        $deleted = $admin->deleteCourse($id);

        if ($deleted) {
            $response = [
                'success' => 'Course has been deleted successfully!'
            ];
        } else {
            $response = [
                'error' => 'Failed to delete Course. Database error.'
            ];
        }
    }
} else {
    $response = [
        'error' => 'No Course selected.'
    ];
}

echo json_encode($response);
exit;
?>