<?php
include('../classes/registrar.php');

$save = new registrar();

if (isset($_POST['student_id'])) {

    $student_id = $_POST['student_id'];
    $section_id = $_POST['section_id'];
    $enrollment_id = $_POST['enrollment_id'];

    $subject_ids = $_POST['subject_id'];
    $grades = $_POST['grade'];
    $remarks = $_POST['remarks'];

    if (empty($student_id) || empty($section_id) || empty($enrollment_id)) {
        echo json_encode(['error' => 'Missing required data']);
        exit;
    }

    $successCount = 0;

    for ($i = 0; $i < count($subject_ids); $i++) {

        $subject_id = $subject_ids[$i];
        $grade = $grades[$i];
        $remark = $remarks[$i];

        // CALL FUNCTION IN CLASS
        $result = $save->saveOrUpdateGrade(
            $student_id,
            $subject_id,
            $section_id,
            $enrollment_id,
            $grade,
            $remark
        );

        if ($result) {
            $successCount++;
        }
    }

    if ($successCount > 0) {
        echo json_encode(['success' => 'Grades saved successfully']);
    } else {
        echo json_encode(['error' => 'Failed to save grades']);
    }

    exit;
}
?>