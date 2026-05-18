<?php
include('../classes/registrar.php');
$registrar = new registrar();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if ($id <= 0) {
        $response = [
            'error' => 'Invalid Section Subject ID.'
        ];
    } else {
        $deleted = $registrar->deleteSectionSubject($id);

        if ($deleted) {
            $response = [
                'success' => 'Section Subject has been deleted successfully!'
            ];
        } else {
            $response = [
                'error' => 'Failed to delete Section Subject. Database error.'
            ];
        }
    }
} else {
    $response = [
        'error' => 'No Section Subject selected.'
    ];
}

echo json_encode($response);
exit;
?>