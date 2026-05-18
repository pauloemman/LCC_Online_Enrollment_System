<?php
include('../classes/registrar.php');
$registrar = new registrar();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if ($id <= 0) {
        $response = [
            'error' => 'Invalid Examinee Account ID.'
        ];
    } else {
        $deleted = $registrar->deleteExamPasser($id);

        if ($deleted) {
            $response = [
                'success' => 'Examinee Account has been deleted successfully!'
            ];
        } else {
            $response = [
                'error' => 'Failed to delete Examinee Account. Database error.'
            ];
        }
    }
} else {
    $response = [
        'error' => 'No Examinee Account selected.'
    ];
}

echo json_encode($response);
exit;
?>