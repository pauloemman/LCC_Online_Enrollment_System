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

}
;
?>