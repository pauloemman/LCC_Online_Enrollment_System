<?php
require_once('connection.php');

class registrar extends Dbh
{
    ////////////////////////////////////////// VERIFICATIONS //////////////////////////////////////////

    //view pending accounts
    public function viewPending()
    {
        $conn = $this->connect();
        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT *
            FROM users 
            WHERE status = 'pending' 
            ORDER BY id DESC";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    //VERIFY ACCOUNT
    public function verifyRegistrar($id)
    {
        $conn = $this->connect();

        $status = "active";

        $stmt = $conn->prepare("
        UPDATE users
        SET status = ?
        WHERE id = ?
    ");

        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {

            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }

        } else {

            return false;

        }
    }

    //DELETE ACCOUNT
    public function deleteVerAccount($id)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {

            // Check if a row was actually deleted
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }

        } else {

            $stmt->close();
            return false;

        }
    }

    ////////////////////////////////////////// CURRICULUM //////////////////////////////////////////

    //view curriculum
    public function viewCurriculum()
    {
        $conn = $this->connect();

        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT 
                curriculum.*,
                courses.course_name,
                courses.course_code
            FROM curriculum
            INNER JOIN courses 
                ON curriculum.course_id = courses.id
            ORDER BY curriculum.id DESC";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    //view courses
    public function viewCourses()
    {
        $conn = $this->connect();

        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * 
            FROM courses 
            ORDER BY id DESC";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    //create curriculum
    public function createCurriculum($courseId, $yearLevel, $semester, $sYear)
    {
        $conn = $this->connect();

        // INSERT CURRICULUM
        $stmt = $conn->prepare("
        INSERT INTO curriculum
        (
            course_id,
            year_level,
            semester,
            school_year,
            created_at
        )
        VALUES
        (
            ?, ?, ?, ?, NOW()
        )
    ");

        $stmt->bind_param(
            "isss",
            $courseId,
            $yearLevel,
            $semester,
            $sYear
        );

        if ($stmt->execute()) {

            return 1;

        } else {

            return 2;
        }
    }

    //update curriculum
    public function updateCurriculum($id, $editCourseId, $editYearLevel, $editSemester, $editSchoolYear)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("
        UPDATE curriculum 
        SET course_id = ?, year_level = ?, semester = ?, school_year = ?   
        WHERE id = ?
    ");

        $stmt->bind_param("ssssi", $editCourseId, $editYearLevel, $editSemester, $editSchoolYear, $id);

        $stmt->execute();

        // IMPORTANT: check if anything was actually updated
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //delete curriculum
    public function deleteCurriculum($id)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("DELETE FROM curriculum WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    ////////////////////////////////////////// CURRICULUM SUBJECTS //////////////////////////////////////////

    //view curriculum subjects 
    public function viewCurriculumSubjects()
    {
        $conn = $this->connect();

        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT

                curriculum_subjects.id,
                curriculum_subjects.curriculum_id,
                curriculum_subjects.subject_id,

                curriculum.year_level,
                curriculum.semester,
                curriculum.school_year,

                subjects.subject_name,
                subjects.subject_code,

                courses.course_name,
                courses.course_code

            FROM curriculum_subjects

            INNER JOIN curriculum
                ON curriculum_subjects.curriculum_id = curriculum.id

            INNER JOIN subjects
                ON curriculum_subjects.subject_id = subjects.id

            INNER JOIN courses
                ON curriculum.course_id = courses.id

            ORDER BY curriculum_subjects.id DESC";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    //view subjects
    public function viewSubjects()
    {
        $conn = $this->connect();

        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * 
            FROM subjects 
            ORDER BY id DESC";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    //add subject curriculum
    public function addSubCurriculum($curriculumId, $subjectId)
    {
        $conn = $this->connect();

        // INSERT SUBJECT CURRICULUM
        $stmt = $conn->prepare("
        INSERT INTO curriculum_subjects
        (
            curriculum_id,
            subject_id
        )
        VALUES
        (
            ?, ?
        )
    ");

        $stmt->bind_param(
            "ii",
            $curriculumId,
            $subjectId
        );

        if ($stmt->execute()) {

            return 1;

        } else {

            return 2;
        }
    }

    //update curriculum subject
    public function updateCurriculumSubject($id, $editCurriculumId, $editSubjectId)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("
        UPDATE curriculum_subjects 
        SET curriculum_id = ?, subject_id = ?   
        WHERE id = ?
    ");

        $stmt->bind_param("ssi", $editCurriculumId, $editSubjectId, $id);

        $stmt->execute();

        // IMPORTANT: check if anything was actually updated
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //delete curriculum subject
    public function deleteCurriculumSubject($id)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("DELETE FROM curriculum_subjects WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    ////////////////////////////////////////// SECTION //////////////////////////////////////////
    //view Course Section
    public function viewCorSec()
    {
        $conn = $this->connect();

        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT 
                sections.*,
                courses.course_name,
                courses.course_code
            FROM sections
            INNER JOIN courses
                ON sections.course_id = courses.id
            ORDER BY sections.id DESC";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    //create section
    public function createSection($courseId, $section, $yearLevel, $semester)
    {
        $conn = $this->connect();

        // INSERT SECTION
        $stmt = $conn->prepare("
        INSERT INTO sections
        (
            course_id,
            section_name,
            year_level,
            semester,
            created_at
        )
        VALUES
        (
            ?, ?, ?, ?, NOW()
        )
    ");

        $stmt->bind_param(
            "isss",
            $courseId,
            $section,
            $yearLevel,
            $semester
        );

        if ($stmt->execute()) {

            return 1;

        } else {

            return 2;
        }
    }

    //update section
    public function updateSection($id, $editCourseId, $editSection, $editYearLevel, $editSemester)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("
        UPDATE sections
        SET course_id = ?, section_name = ?, year_level = ?, semester = ? 
        WHERE id = ?
    ");

        $stmt->bind_param("ssssi", $editCourseId, $editSection, $editYearLevel, $editSemester, $id);

        $stmt->execute();

        // IMPORTANT: check if anything was actually updated
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //delete section
    public function deleteSection($id)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("DELETE FROM sections WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    ////////////////////////////////////////// SECTION SUBJECTS //////////////////////////////////////////

    //view section subjects 
    public function viewSectionSubjects()
    {
        $conn = $this->connect();

        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT

                section_subjects.id,
                section_subjects.section_id,
                section_subjects.subject_id,
                section_subjects.schedule,
                section_subjects.room,
                section_subjects.instructor,

                sections.section_name,
                sections.year_level,
                sections.semester,

                subjects.subject_name,
                subjects.subject_code,

                courses.course_name,
                courses.course_code

            FROM section_subjects

            INNER JOIN sections
                ON section_subjects.section_id = sections.id

            INNER JOIN subjects
                ON section_subjects.subject_id = subjects.id

            INNER JOIN courses
                ON sections.course_id = courses.id

            ORDER BY section_subjects.id DESC";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    //view sections
    public function viewSections()
    {
        $conn = $this->connect();

        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * 
            FROM sections 
            ORDER BY id DESC";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    //add subject section
    public function addSubjectSection($sectionId, $subjectId, $schedule, $room, $instructor)
    {
        $conn = $this->connect();

        // INSERT SUBJECT SECTION
        $stmt = $conn->prepare("
        INSERT INTO section_subjects
        (
            section_id,
            subject_id,
            schedule,
            room,
            instructor,
            created_at
        )
        VALUES
        (
            ?, ?, ?, ?, ?, NOW()
        )
    ");

        $stmt->bind_param(
            "iisss",
            $sectionId,
            $subjectId,
            $schedule,
            $room,
            $instructor
        );

        if ($stmt->execute()) {

            return 1;

        } else {

            return 2;
        }
    }

    //update section subject
    public function updateSectionSubject($id, $editCurriculumId, $editSubjectId, $editSchedule, $editRoom, $editInstructor)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("
        UPDATE section_subjects 
        SET section_id = ?, subject_id = ?, schedule = ?, room = ?, instructor = ?   
        WHERE id = ?
    ");

        $stmt->bind_param("sssssi", $editCurriculumId, $editSubjectId, $editSchedule, $editRoom, $editInstructor, $id);

        $stmt->execute();

        // IMPORTANT: check if anything was actually updated
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //delete subject subject
    public function deleteSectionSubject($id)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("DELETE FROM section_subjects WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    ////////////////////////////////////////// EXAM PASSERS //////////////////////////////////////////

    //view exam passers
    public function viewExamPassers()
    {
        $conn = $this->connect();
        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT *
            FROM exam_passers
            ORDER BY id DESC";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    //create curriculum
    public function addAccount($applicant, $fname, $mname, $lname, $email, $exStatus)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("
        INSERT INTO exam_passers
        (
            applicant_no,
            first_name,
            middle_name,
            last_name,
            email,
            exam_status,
            created_at
        )
        VALUES
        (
            ?, ?, ?, ?, ?, ?, NOW()
        )
    ");

        $stmt->bind_param(
            "ssssss",
            $applicant,
            $fname,
            $mname,
            $lname,
            $email,
            $exStatus
        );

        if ($stmt->execute()) {

            return 1;

        } else {

            return 2;
        }
    }

    //update exam passer account
    public function editAccount($id, $editApplicant, $editFname, $editMname, $editLname, $editEmail, $editExStatus)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("
        UPDATE exam_passers 
        SET applicant_no = ?, first_name = ?, middle_name = ?, last_name = ?, email = ?, exam_status = ?
        WHERE id = ?
    ");

        $stmt->bind_param("ssssssi", $editApplicant, $editFname, $editMname, $editLname, $editEmail, $editExStatus, $id);

        $stmt->execute();

        // IMPORTANT: check if anything was actually updated
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //delete exam passer
    public function deleteExamPasser($id)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("DELETE FROM exam_passers WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // view enrollments
    public function viewEnrollments()
    {
        $conn = $this->connect();

        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT

            enrollment.id,
            enrollment.year_level,
            enrollment.semester,
            enrollment.enrollment_status,

            students.student_no,
            students.first_name,
            students.middle_name,
            students.last_name,

            sections.section_name,

            courses.course_name

        FROM enrollment

        INNER JOIN students
            ON enrollment.student_id = students.id

        INNER JOIN sections
            ON enrollment.section_id = sections.id

        INNER JOIN curriculum
            ON enrollment.curriculum_id = curriculum.id

        INNER JOIN courses
            ON curriculum.course_id = courses.id

        WHERE enrollment.enrollment_status = 'Pending'

        ORDER BY enrollment.id DESC";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    //approve enrollment
    public function approveEnrollment($id)
    {
        $conn = $this->connect();

        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        // GET STUDENT ID
        $sql = "SELECT student_id
            FROM enrollment
            WHERE id = ?";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return false;
        }

        $row = $result->fetch_assoc();
        $studentId = $row['student_id'];

        // UPDATE ENROLLMENT TABLE
        $sqlEnrollment = "UPDATE enrollment
                      SET enrollment_status = 'Approved'
                      WHERE id = ?";

        $stmtEnrollment = $conn->prepare($sqlEnrollment);

        if (!$stmtEnrollment) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmtEnrollment->bind_param("i", $id);

        // UPDATE STUDENTS TABLE
        $sqlStudent = "UPDATE students
                   SET enrollment_status = 'Approved'
                   WHERE id = ?";

        $stmtStudent = $conn->prepare($sqlStudent);

        if (!$stmtStudent) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmtStudent->bind_param("i", $studentId);

        $successEnrollment = $stmtEnrollment->execute();
        $successStudent = $stmtStudent->execute();

        return $successEnrollment && $successStudent;
    }

    public function searchApprovedStudents($search = '')
    {
        $conn = $this->connect();

        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT
                enrollment.id AS enrollment_id,
                enrollment.student_id,
                enrollment.section_id,

                students.student_no,
                students.first_name,
                students.middle_name,
                students.last_name,

                sections.section_name,

                courses.course_name

            FROM enrollment

            INNER JOIN students
                ON enrollment.student_id = students.id

            INNER JOIN sections
                ON enrollment.section_id = sections.id

            INNER JOIN curriculum
                ON enrollment.curriculum_id = curriculum.id

            INNER JOIN courses
                ON curriculum.course_id = courses.id

            WHERE enrollment.enrollment_status = 'Approved'";

        // OPTIONAL SEARCH FILTER
        if (!empty($search)) {
            $sql .= " AND (
                    students.student_no LIKE ?
                    OR students.first_name LIKE ?
                    OR students.last_name LIKE ?
                )";
        }

        $sql .= " ORDER BY enrollment.id DESC";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        // bind search if exists
        if (!empty($search)) {

            $like = "%{$search}%";

            $stmt->bind_param("sss", $like, $like, $like);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    public function getStudentById($id)
    {
        $conn = $this->connect();

        $sql = "SELECT * FROM students WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getSectionSubjects($section_id)
    {
        $conn = $this->connect();

        $sql = "SELECT
                section_subjects.subject_id,
                section_subjects.instructor,
                subjects.subject_name
            FROM section_subjects
            INNER JOIN subjects
                ON section_subjects.subject_id = subjects.id
            WHERE section_subjects.section_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $section_id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function saveOrUpdateGrade(
        $student_id,
        $subject_id,
        $section_id,
        $enrollment_id,
        $grade,
        $remarks
    ) {
        $conn = $this->connect();

        // CHECK IF EXISTS
        $check = "SELECT id FROM student_grades
              WHERE student_id = ?
              AND subject_id = ?
              AND enrollment_id = ?";

        $stmt = $conn->prepare($check);
        $stmt->bind_param("iii", $student_id, $subject_id, $enrollment_id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            // UPDATE EXISTING
            $row = $result->fetch_assoc();
            $id = $row['id'];

            $update = "UPDATE student_grades
                   SET grade = ?, remarks = ?
                   WHERE id = ?";

            $stmt2 = $conn->prepare($update);
            $stmt2->bind_param("dsi", $grade, $remarks, $id);

            return $stmt2->execute();

        } else {

            // INSERT NEW
            $insert = "INSERT INTO student_grades
            (student_id, subject_id, section_id, enrollment_id, grade, remarks)
            VALUES (?, ?, ?, ?, ?, ?)";

            $stmt3 = $conn->prepare($insert);
            $stmt3->bind_param(
                "iiiids",
                $student_id,
                $subject_id,
                $section_id,
                $enrollment_id,
                $grade,
                $remarks
            );

            return $stmt3->execute();
        }
    }

}
;
?>