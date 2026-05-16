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

}
;
?>