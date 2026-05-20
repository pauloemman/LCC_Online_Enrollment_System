<?php

include('../classes/students.php');
include('../mail.php');

$students = new Users();

if (isset($_POST['register'])) {

    $applicant_no = trim($_POST['applicant_no']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // VALIDATION
    if (
        $applicant_no == '' ||
        $name == '' ||
        $email == '' ||
        $password == ''
    ) {

        $response = array(
            'error' => "All fields are required!"
        );

    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $response = array(
            'error' => "Invalid email format!"
        );

    } else if (
        strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[0-9]/', $password)
    ) {

        $response = array(
            'error' =>
                "Password must be at least 8 characters long, include 1 uppercase letter and 1 number."
        );

    } else {

        // HASH PASSWORD
        $hashed_password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        // GENERATE VERIFICATION TOKEN
        $token = bin2hex(random_bytes(32));

        // REGISTER USER
        $insert = $students->register(
            $applicant_no,
            $name,
            $email,
            $hashed_password,
            $token
        );

        // SUCCESS
        if ($insert === 1) {

            // VERIFICATION LINK
            $verification_link =
                "http://localhost/LCC_Online_Enrollment_System/verify.php?token=$token";

            // EMAIL SUBJECT
            $subject = "Verify Your Email";

            // EMAIL BODY
            $message = "
                <h2>LCC Online Enrollment</h2>

                <p>Hello <b>$name</b>,</p>

                <p>
                    Your account has been created successfully.
                </p>

                <p>
                    Please click the button below to verify your email.
                </p>

                <br>

                <a href='$verification_link'
                    style='
                        background:#2563eb;
                        color:white;
                        padding:12px 20px;
                        text-decoration:none;
                        border-radius:6px;
                        display:inline-block;
                    '>
                    Verify Email
                </a>

                <br><br>

                <p>
                    If you did not create this account,
                    please ignore this email.
                </p>
            ";

            // SEND EMAIL
            $mailSent = sendMail(
                $email,
                $subject,
                $message
            );

            if ($mailSent) {

                $response = array(
                    'success' =>
                        "Account created successfully! Verification email sent."
                );

            } else {

                $response = array(
                    'error' =>
                        "Account created, but email failed to send."
                );
            }

        } else if ($insert === 2) {

            $response = array(
                'error' => "Database error."
            );

        } else if ($insert === 3) {

            $response = array(
                'error' =>
                    "Applicant number not found or not qualified."
            );

        } else if ($insert === 4) {

            $response = array(
                'error' => "Email already exists."
            );

        } else if ($insert === 5) {

            $response = array(
                'error' => "Applicant already registered."
            );

        } else {

            $response = array(
                'error' => "Something went wrong."
            );
        }
    }

    echo json_encode($response);
    exit;
}
?>