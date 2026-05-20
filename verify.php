<?php

include('classes/connection.php');

$db = new Dbh();
$conn = $db->connect();

if (isset($_GET['token'])) {

    $token = $_GET['token'];

    $stmt = $conn->prepare("
        UPDATE users
        SET
            email_verified = 1,
            status = 'active',
            verification_token = NULL
        WHERE verification_token = ?
    ");

    $stmt->bind_param("s", $token);

    if ($stmt->execute() && $stmt->affected_rows > 0) {

        echo "
            <h2>Email verified successfully.</h2>
            <a href='public/home.php'>
                Login Now
            </a>
        ";

    } else {

        echo "Invalid or expired verification link.";
    }
}
?>