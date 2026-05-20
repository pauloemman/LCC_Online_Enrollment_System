<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../assets/css/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>

<body>

    <?php

    require_once('../../classes/connection.php');

    $db = new Dbh();
    $conn = $db->connect();

    $userId = $_SESSION['id'] ?? null;

    $studentStatus = 'Not Found';

    if ($userId) {

        $stmt = $conn->prepare("
        SELECT enrollment_status
        FROM students
        WHERE user_id = ?
        LIMIT 1
    ");

        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $student = $result->fetch_assoc();

            $studentStatus = $student['enrollment_status'];
        }
    }

    ?>