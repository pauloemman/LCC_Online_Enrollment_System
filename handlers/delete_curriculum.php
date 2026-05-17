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
        $deleted = $registrar->deleteCurriculum($id);

        if ($deleted) {
            $response = [
                'success' => 'Curriculum has been deleted successfully!'
            ];
        } else {
            $response = [
                'error' => 'Failed to delete Curriculum. Database error.'
            ];
        }
    }
} else {
    $response = [
        'error' => 'No Curriculum selected.'
    ];
}

echo json_encode($response);
exit;
?>