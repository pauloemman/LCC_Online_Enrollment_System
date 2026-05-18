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
        $deleted = $registrar->deleteCurriculumSubject($id);

        if ($deleted) {
            $response = [
                'success' => 'Subject Curriculum has been deleted successfully!'
            ];
        } else {
            $response = [
                'error' => 'Failed to delete Subject Curriculum. Database error.'
            ];
        }
    }
} else {
    $response = [
        'error' => 'No Subject Curriculum selected.'
    ];
}

echo json_encode($response);
exit;
?>