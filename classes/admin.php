<?php
require_once('connection.php');

class admins extends Dbh
{
    ////////////////////////////////////////// REGISTRAR //////////////////////////////////////////
    //view registrars
    public function viewRegistrars()
    {
        $conn = $this->connect();
        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT *
            FROM users 
            WHERE role = ? 
            ORDER BY id DESC";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $role = "registrar";
        $stmt->bind_param("s", $role);

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    //create registrar account
    public function registerRegistrar($name, $email, $hashed_password)
    {
        $conn = $this->connect();

        // Check name
        $search_name = $conn->prepare("SELECT name FROM users WHERE name = ?");
        $search_name->bind_param("s", $name);
        $search_name->execute();
        $search_name->store_result();

        if ($search_name->num_rows > 0) {
            return 3; // name already exists
        }

        // Check email
        $search_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $search_email->bind_param("s", $email);
        $search_email->execute();
        $search_email->store_result();

        if ($search_email->num_rows > 0) {
            return 4; // email already exists
        }

        $role = "registrar";
        $status = "active";

        // INSERT
        $stmt = $conn->prepare("
        INSERT INTO users (name, email, password, role, status) 
        VALUES (?, ?, ?, ?, ?)
    ");

        $stmt->bind_param("sssss", $name, $email, $hashed_password, $role, $status);

        if ($stmt->execute()) {
            return 1; // success
        } else {
            return 2; // error
        }
    }

    //edit registrar account
    public function updateRegistrar($name, $email, $password)
    {
        $conn = $this->connect();

        // IF PASSWORD IS CHANGED
        if (!empty($password)) {

            $stmt = $conn->prepare("
            UPDATE users
            SET name = ?, password = ?
            WHERE email = ?
        ");

            $stmt->bind_param("sss", $name, $password, $email);

        }

        // IF PASSWORD IS EMPTY
        else {

            $stmt = $conn->prepare("
            UPDATE users
            SET name = ?
            WHERE email = ?
        ");

            $stmt->bind_param("ss", $name, $email);
        }

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //delete registrar account
    public function deleteRegistrar($id)
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

    ////////////////////////////////////////// DEPARTMENTS //////////////////////////////////////////
    //view departments
    public function viewDepartments()
    {
        $conn = $this->connect();

        if (!$conn) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * 
            FROM departments 
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

    //create department
    public function createDepartment($depName, $code)
    {
        $conn = $this->connect();

        // Check name
        $search_name = $conn->prepare("SELECT department_name FROM departments WHERE department_name = ?");
        $search_name->bind_param("s", $depName);
        $search_name->execute();
        $search_name->store_result();

        if ($search_name->num_rows > 0) {
            return 3; // name already exists
        }

        // Check email
        $search_email = $conn->prepare("SELECT department_code FROM departments WHERE department_code = ?");
        $search_email->bind_param("s", $code);
        $search_email->execute();
        $search_email->store_result();

        if ($search_email->num_rows > 0) {
            return 4; // email already exists
        }

        // INSERT
        $stmt = $conn->prepare("
        INSERT INTO departments (department_name, department_code, created_at) 
        VALUES (?, ?, NOW())
    ");

        $stmt->bind_param("ss", $depName, $code);

        if ($stmt->execute()) {
            return 1; // success
        } else {
            return 2; // error
        }
    }

    //update departments
    public function updateDepartment($id, $depName, $code)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("
        UPDATE departments 
        SET department_name = ?, department_code = ? 
        WHERE id = ?
    ");

        $stmt->bind_param("ssi", $depName, $code, $id);

        $stmt->execute();

        // IMPORTANT: check if anything was actually updated
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //delete department
    public function deleteDepartment($id)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("DELETE FROM departments WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    ////////////////////////////////////////// COURSES //////////////////////////////////////////
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

    //create course
    public function createCourse($departmentId, $couName, $couCode)
    {
        $conn = $this->connect();

        // CHECK COURSE NAME
        $search_name = $conn->prepare("
        SELECT course_name 
        FROM courses 
        WHERE course_name = ?
    ");

        $search_name->bind_param("s", $couName);

        $search_name->execute();

        $search_name->store_result();

        if ($search_name->num_rows > 0) {
            return 3;
        }

        // CHECK COURSE CODE
        $search_code = $conn->prepare("
        SELECT course_code 
        FROM courses 
        WHERE course_code = ?
    ");

        $search_code->bind_param("s", $couCode);

        $search_code->execute();

        $search_code->store_result();

        if ($search_code->num_rows > 0) {
            return 4;
        }

        // INSERT COURSE
        $stmt = $conn->prepare("
        INSERT INTO courses
        (
            department_id,
            course_name,
            course_code,
            created_at
        )
        VALUES
        (
            ?, ?, ?, NOW()
        )
    ");

        $stmt->bind_param(
            "iss",
            $departmentId,
            $couName,
            $couCode
        );

        if ($stmt->execute()) {

            return 1;

        } else {

            return 2;
        }
    }

    //update course
    public function updateCourse($id, $editCouName, $editCouCode)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("
        UPDATE courses 
        SET course_name = ?, course_code = ? 
        WHERE id = ?
    ");

        $stmt->bind_param("ssi", $editCouName, $editCouCode, $id);

        $stmt->execute();

        // IMPORTANT: check if anything was actually updated
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //delete course
    public function deleteCourse($id)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    ////////////////////////////////////////// SUBJECTS //////////////////////////////////////////
    //view courses
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

    //create subject
    public function createSubject(
        $courseId,
        $subCode,
        $subName,
        $lecUnits,
        $labUnits,
        $yearLevel,
        $semester
    ) {

        $conn = $this->connect();

        // CHECK SUBJECT NAME
        $search_name = $conn->prepare("
        SELECT subject_name
        FROM subjects
        WHERE subject_name = ?
    ");

        $search_name->bind_param("s", $subName);

        $search_name->execute();

        $search_name->store_result();

        if ($search_name->num_rows > 0) {

            return 3;
        }

        // CHECK SUBJECT CODE
        $search_code = $conn->prepare("
        SELECT subject_code
        FROM subjects
        WHERE subject_code = ?
    ");

        $search_code->bind_param("s", $subCode);

        $search_code->execute();

        $search_code->store_result();

        if ($search_code->num_rows > 0) {

            return 4;
        }

        // INSERT SUBJECT
        $stmt = $conn->prepare("
        INSERT INTO subjects
        (
            course_id,
            subject_code,
            subject_name,
            lecture_units,
            lab_units,
            year_level,
            semester,
            created_at
        )
        VALUES
        (
            ?, ?, ?, ?, ?, ?, ?, NOW()
        )
    ");

        $stmt->bind_param(
            "issiiss",
            $courseId,
            $subCode,
            $subName,
            $lecUnits,
            $labUnits,
            $yearLevel,
            $semester
        );

        if ($stmt->execute()) {

            return 1;

        } else {

            return 2;
        }
    }

    //update subject
    public function updateSubject($id, $editSubCode, $editSubName, $editLecUnits, $editLabUnits, $editYearLevel, $editSemester)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("
        UPDATE subjects 
        SET 
            subject_name = ?, 
            subject_code = ?, 
            lecture_units = ?, 
            lab_units = ?, 
            year_level = ?, 
            semester = ?
        WHERE id = ?
    ");

        $stmt->bind_param(
            "ssiissi",
            $editSubName,
            $editSubCode,
            $editLecUnits,
            $editLabUnits,
            $editYearLevel,
            $editSemester,
            $id
        );

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //delete subject
    public function deleteSubject($id)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("DELETE FROM subjects WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
?>