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
        // Get data from form
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        // Get the optional contact number (if provided)
        $contactNumber = isset($_POST['contactNumber']) && !empty($_POST['contactNumber']) ? $_POST['contactNumber'] : NULL;

        // Insert data into database
        $sql = "INSERT INTO contact (name, email, subject, message, contact) 
                VALUES ('$name', '$email', '$subject', '$message', '$contactNumber')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Thank you for contacting us! <br> Your response has been submitted successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }

    // Close database connection
    $conn->close();
?>
