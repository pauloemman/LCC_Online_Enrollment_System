<?php
include('../classes/admin.php');
$admin = new admins();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if ($id <= 0) {
        $response = [
            'error' => 'Invalid Registrar Account ID.'
        ];
    } else {
        $deleted = $admin->deleteRegistrar($id);

        if ($deleted) {
            $response = [
                'success' => 'Registrar Account has been deleted successfully!'
            ];
        } else {
            $response = [
                'error' => 'Failed to delete Registrar Account. Database error.'
            ];
        }
    }
} else {
    $response = [
        'error' => 'No Registrar Account selected.'
    ];
}

echo json_encode($response);
exit;
?>