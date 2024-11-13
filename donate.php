<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paws_db";

// Create a new PDO connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $donorName = isset($_POST['anonymous']) && $_POST['anonymous'] == 1 ? "Anonymous" : htmlspecialchars($_POST['donorName']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
    $amount = $_POST['amount'];
    $paymentMethod = $_POST['paymentMethod'];
    $donationPurpose = $_POST['donationPurpose'];
    $anonymous = isset($_POST['anonymous']) ? 1 : 0;
    $message = htmlspecialchars($_POST['message']);
    $subscribe = isset($_POST['subscribe']) ? 1 : 0;

    // Prepare the SQL statement to insert donation data
    $sql = "INSERT INTO donations 
            (donor_name, email, password, amount, payment_method, donation_purpose, anonymous, message, subscribe) 
            VALUES 
            (:donorName, :email, :password, :amount, :paymentMethod, :donationPurpose, :anonymous, :message, :subscribe)";
    
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':donorName', $donorName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':paymentMethod', $paymentMethod);
    $stmt->bindParam(':donationPurpose', $donationPurpose);
    $stmt->bindParam(':anonymous', $anonymous);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':subscribe', $subscribe);
// Prepare and execute SQL statement, then redirect on success
if ($stmt->execute()) {
    header("Location: index.html?success=1");  // Redirect with a success flag
    exit();
} else {
    echo "There was an error submitting your donation.";
}

}
?>
