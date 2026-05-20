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
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once '../../classes/connection.php';

    $db = new Dbh();
    $conn = $db->connect();

    // Departments
    $departmentQuery = mysqli_query($conn, "SELECT * FROM departments");
    $departments = mysqli_fetch_all($departmentQuery, MYSQLI_ASSOC);

    // Courses
    $courseQuery = mysqli_query($conn, "SELECT * FROM courses");
    $courses = mysqli_fetch_all($courseQuery, MYSQLI_ASSOC);

    // Curriculums
    $curriculumQuery = mysqli_query($conn, "
    SELECT curriculum.*, courses.course_name
    FROM curriculum
    INNER JOIN courses ON curriculum.course_id = courses.id
");
    $curriculums = mysqli_fetch_all($curriculumQuery, MYSQLI_ASSOC);

    // Sections
    $sectionQuery = mysqli_query($conn, "
    SELECT sections.*, courses.course_code
    FROM sections
    INNER JOIN courses ON sections.course_id = courses.id
");
    $sections = mysqli_fetch_all($sectionQuery, MYSQLI_ASSOC);
    ?>