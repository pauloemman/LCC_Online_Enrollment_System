<?php

session_start();

include('../classes/connection.php');

$db = new Dbh();
$conn = $db->connect();

if (!isset($_SESSION['id'])) {

    echo json_encode([
        'error' => 'You are not logged in.'
    ]);

    exit;
}

$userId = $_SESSION['id'];

$curriculumId = trim($_POST['curriculumId'] ?? '');
$sectionId = trim($_POST['sectionId'] ?? '');

if ($curriculumId == '' || $sectionId == '') {

    echo json_encode([
        'error' => 'Please select curriculum and section.'
    ]);

    exit;
}

try {

    // =====================================================
    // GET STUDENT INFO
    // =====================================================
    $stmt = $conn->prepare("
        SELECT
            id,
            enrollment_status,
            current_year_level,
            current_semester
        FROM students
        WHERE user_id = ?
        LIMIT 1
    ");

    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 0) {

        echo json_encode([
            'error' => 'Student record not found.'
        ]);

        exit;
    }

    $student = $result->fetch_assoc();

    $studentId = $student['id'];
    $enrollmentStatus = $student['enrollment_status'];
    $currentYearLevel = $student['current_year_level'];
    $currentSemester = $student['current_semester'];

    // =====================================================
    // CHECK IF PREVIOUS ENROLLMENT IS APPROVED
    // =====================================================
    if ($enrollmentStatus != 'Approved') {

        echo json_encode([
            'error' => 'Your previous enrollment is not yet approved.'
        ]);

        exit;
    }

    // =====================================================
    // GET CURRICULUM INFO
    // =====================================================
    $cur = $conn->prepare("
        SELECT year_level, semester
        FROM curriculum
        WHERE id = ?
    ");

    $cur->bind_param("i", $curriculumId);
    $cur->execute();

    $curRes = $cur->get_result();

    if ($curRes->num_rows == 0) {

        echo json_encode([
            'error' => 'Invalid curriculum.'
        ]);

        exit;
    }

    $curriculum = $curRes->fetch_assoc();

    $yearLevel = $curriculum['year_level'];
    $semester = $curriculum['semester'];

    // =====================================================
    // CHECK IF ALREADY ENROLLED IN SAME SEMESTER
    // =====================================================
    $check = $conn->prepare("
        SELECT id
        FROM enrollment
        WHERE student_id = ?
        AND year_level = ?
        AND semester = ?
    ");

    $check->bind_param(
        "iss",
        $studentId,
        $yearLevel,
        $semester
    );

    $check->execute();

    $checkResult = $check->get_result();

    if ($checkResult->num_rows > 0) {

        echo json_encode([
            'error' => 'You are already enrolled for this semester.'
        ]);

        exit;
    }

    // =====================================================
    // INSERT ENROLLMENT
    // =====================================================
    $insert = $conn->prepare("
        INSERT INTO enrollment (
            student_id,
            curriculum_id,
            section_id,
            year_level,
            semester
        )
        VALUES (?, ?, ?, ?, ?)
    ");

    $insert->bind_param(
        "iiiss",
        $studentId,
        $curriculumId,
        $sectionId,
        $yearLevel,
        $semester
    );

    if ($insert->execute()) {

        // =====================================================
        // UPDATE STUDENT CURRENT PROGRESS
        // =====================================================
        $updateStudent = $conn->prepare("
            UPDATE students
            SET
                current_year_level = ?,
                current_semester = ?,
                enrollment_status = 'Pending'
            WHERE id = ?
        ");

        $updateStudent->bind_param(
            "ssi",
            $yearLevel,
            $semester,
            $studentId
        );

        $updateStudent->execute();

        echo json_encode([
            'success' => 'Enrollment successful.'
        ]);

    } else {

        echo json_encode([
            'error' => 'Failed to enroll student.'
        ]);
    }

} catch (Exception $e) {

    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
?>