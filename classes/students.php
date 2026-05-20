<?php
require_once('connection.php');


class Users extends Dbh
{

    public function register($applicant_no, $name, $email, $hashed_password, $token)
    {
        $conn = $this->connect();

        $check_exam = $conn->prepare("
        SELECT id 
        FROM exam_passers
        WHERE applicant_no = ?
        AND exam_status = 'Passed'
    ");

        $check_exam->bind_param("s", $applicant_no);
        $check_exam->execute();
        $check_exam->store_result();

        if ($check_exam->num_rows == 0) {
            return 3;
        }

        $search_email = $conn->prepare("
        SELECT email 
        FROM users 
        WHERE email = ?
    ");

        $search_email->bind_param("s", $email);
        $search_email->execute();
        $search_email->store_result();

        if ($search_email->num_rows > 0) {
            return 4;
        }

        $search_applicant = $conn->prepare("
        SELECT id 
        FROM users 
        WHERE applicant_no = ?
    ");

        $search_applicant->bind_param("s", $applicant_no);
        $search_applicant->execute();
        $search_applicant->store_result();

        if ($search_applicant->num_rows > 0) {
            return 5;
        }

        $role = "student";

        $status = "pending";

        // INSERT USER
        $stmt = $conn->prepare("
        INSERT INTO users
        (
            applicant_no,
            name,
            email,
            password,
            role,
            status,
            verification_token,
            email_verified
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, 0)
    ");

        $stmt->bind_param(
            "sssssss",
            $applicant_no,
            $name,
            $email,
            $hashed_password,
            $role,
            $status,
            $token
        );

        if ($stmt->execute()) {
            return 1;
        }

        return 2;
    }

    //login
    public function login($email, $password)
    {
        session_start();

        $conn = $this->connect();

        $stmt = $conn->prepare("
        SELECT id, name, email, password, role, status 
        FROM users 
        WHERE email = ?
    ");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if email exists
        if ($result->num_rows === 0) {
            return 8; // email not found
        }

        $row = $result->fetch_assoc();

        // Verify password
        if (!password_verify($password, $row['password'])) {
            return 9; // wrong password
        }

        // Check status
        if ($row['status'] === 'pending') {
            return 10; // account not approved
        }

        // Set session (FIXED: id instead of s_id)
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        // Role-based redirect
        if ($row['role'] === 'student') {
            return '../public/students/home.php';
        } elseif ($row['role'] === 'registrar') {
            return '../public/registrar/home.php';
        } elseif ($row['role'] === 'admin') {
            return '../public/admin/home.php';
        } else {
            return 11; // unknown role (safety)
        }
    }

    //enroll new
    public function enrolNew(
        $userId,
        $fname,
        $mname,
        $lname,
        $gender,
        $bday,
        $cNum,
        $address,
        $departmentId,
        $courseId,
        $curriculumId,
        $sectionId
    ) {

        $conn = $this->connect();

        // GET year level and semester from curriculum
        $curriculumQuery = $conn->prepare("
        SELECT year_level, semester
        FROM curriculum
        WHERE id = ?
    ");

        $curriculumQuery->bind_param("i", $curriculumId);
        $curriculumQuery->execute();

        $result = $curriculumQuery->get_result();

        if ($result->num_rows == 0) {
            return 3; // Curriculum not found
        }

        $curriculumData = $result->fetch_assoc();

        $yearLevel = $curriculumData['year_level'];
        $semester = $curriculumData['semester'];

        // GENERATE STUDENT NUMBER

        $yearMonth = date('Ym'); // example: 202605

        // GET LAST STUDENT NUMBER THIS MONTH
        $getLastStudent = $conn->prepare("
    SELECT student_no
    FROM students
    WHERE student_no LIKE ?
    ORDER BY student_no DESC
    LIMIT 1
");

        $searchPattern = $yearMonth . '%';

        $getLastStudent->bind_param("s", $searchPattern);
        $getLastStudent->execute();

        $lastResult = $getLastStudent->get_result();

        if ($lastResult->num_rows > 0) {

            $lastStudent = $lastResult->fetch_assoc();

            // GET LAST 4 DIGITS
            $lastNumber = substr($lastStudent['student_no'], -4);

            // INCREMENT
            $nextNumber = intval($lastNumber) + 1;

        } else {

            // FIRST STUDENT THIS MONTH
            $nextNumber = 1;
        }

        // FORMAT TO 4 DIGITS
        $formattedNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // FINAL STUDENT NUMBER
        $studentNo = $yearMonth . $formattedNumber;

        // INSERT INTO students
        $stmt = $conn->prepare("
        INSERT INTO students
(
    user_id,
    student_no,
    first_name,
    middle_name,
    last_name,
    gender,
    birthdate,
    contact_no,
    address,
    department_id,
    course_id,
    current_year_level,
    current_semester
)
VALUES
(
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)
    ");

        $stmt->bind_param(
            "issssssssiiss",
            $userId,
            $studentNo,
            $fname,
            $mname,
            $lname,
            $gender,
            $bday,
            $cNum,
            $address,
            $departmentId,
            $courseId,
            $yearLevel,
            $semester
        );

        // CHECK student insert
        if (!$stmt->execute()) {
            return 2; // Student insert failed
        }

        // GET inserted student ID
        $studentId = $conn->insert_id;

        // INSERT INTO enrollment
        $enrollmentStmt = $conn->prepare("
        INSERT INTO enrollment
        (
            student_id,
            curriculum_id,
            section_id,
            year_level,
            semester
        )
        VALUES
        (
            ?, ?, ?, ?, ?
        )
    ");

        $enrollmentStmt->bind_param(
            "iiiss",
            $studentId,
            $curriculumId,
            $sectionId,
            $yearLevel,
            $semester
        );

        // CHECK enrollment insert
        if ($enrollmentStmt->execute()) {

            return 1; // Success

        } else {

            return 4; // Enrollment insert failed
        }
    }

}
?>