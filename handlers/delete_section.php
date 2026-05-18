<?php
include('../classes/registrar.php');
$registrar = new registrar();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if ($id <= 0) {
        $response = [
            'error' => 'Invalid Curriculum ID.'
        ];
    } else {
        $deleted = $registrar->deleteSection($id);

        if ($deleted) {
            $response = [
                'success' => 'Section has been deleted successfully!'
            ];
        } else {
            $response = [
                'error' => 'Failed to delete Section. Database error.'
            ];
        }
    }
} else {
    $response = [
        'error' => 'No Section selected.'
    ];
}

echo json_encode($response);
exit;
?>