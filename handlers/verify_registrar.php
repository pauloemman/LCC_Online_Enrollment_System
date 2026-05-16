<?php

include('../classes/registrar.php');

$admin = new registrar();

header('Content-Type: application/json');

if (isset($_POST['id'])) {

    $id = intval($_POST['id']);

    if ($id <= 0) {

        $response = array(
            'error' => 'Invalid account ID.'
        );

    } else {

        $verify = $admin->verifyRegistrar($id);

        if ($verify) {

            $response = array(
                'success' => 'Registrar account verified successfully!'
            );

        } else {

            $response = array(
                'error' => 'Failed to verify account.'
            );

        }
    }

} else {

    $response = array(
        'error' => 'No account selected.'
    );

}

echo json_encode($response);
exit;

?>