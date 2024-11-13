<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "paws_db";      

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Check if the email already exists
    $checkEmail = $conn->prepare("SELECT email FROM volunteers WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        // Email already exists in the database
        echo "This email is already registered. Please use a different email.";
    } else {
        // Prepare and bind the SQL query to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO volunteers (full_name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $message);

        // Execute the statement and check if the insertion was successful
        if ($stmt->execute()) {
            echo "Thank you for volunteering! We will be in touch.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $checkEmail->close();
    $conn->close();
}
?>
