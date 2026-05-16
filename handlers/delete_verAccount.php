<?php
include('../classes/registrar.php');
$admin = new registrar();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if ($id <= 0) {
        $response = [
            'error' => 'Invalid Account ID.'
        ];
    } else {
        $deleted = $admin->deleteVerAccount($id);

        if ($deleted) {
            $response = [
                'success' => 'Account has been deleted successfully!'
            ];
        } else {
            $response = [
                'error' => 'Failed to delete Account. Database error.'
            ];
        }
    }
} else {
    $response = [
        'error' => 'No Account selected.'
    ];
}

echo json_encode($response);
exit;
?>