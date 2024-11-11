<?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "paws_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get data from contact form
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        // Get the optional contact number (if provided)
        $contactNumber = isset($_POST['contactNumber']) && !empty($_POST['contactNumber']) ? $_POST['contactNumber'] : NULL;

        // Insert data into contact table
        $sql_contact = "INSERT INTO contact (name, email, subject, message, contact) 
                        VALUES ('$name', '$email', '$subject', '$message', '$contactNumber')";

        if ($conn->query($sql_contact) === TRUE) {
            echo "<div class='alert alert-success'>Thank you for contacting us! <br> Your response has been submitted successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql_contact . "<br>" . $conn->error . "</div>";
        }

        // Get data from adoption form
        $full_name = $_POST['full_name'];
        $adopt_email = $_POST['email']; 
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $date_of_birth = $_POST['date_of_birth'];
        $pet_type = $_POST['pet_type'];
        $age_preference = $_POST['age_preference'];
        $experience = $_POST['experience'];
        $living_conditions = $_POST['living_conditions'];
        $reason = $_POST['reason'];

        // Insert data into adopt_applications table
        $sql_adoptForm = "INSERT INTO adopt_applications (full_name, email, phone, address, date_of_birth, pet_type, age_preference, experience, living_conditions, reason) 
                      VALUES ('$full_name', '$adopt_email', '$phone', '$address', '$date_of_birth', '$pet_type', '$age_preference', '$experience', '$living_conditions', '$reason')";

        if ($conn->query($sql_adoptForm) === TRUE) {
            echo "<div class='alert alert-success'>Thank you for your adoption application! <br> Your application has been submitted successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql_adoptForm . "<br>" . $conn->error . "</div>";
        }
    }

    // Close database connection
    $conn->close();
?>
