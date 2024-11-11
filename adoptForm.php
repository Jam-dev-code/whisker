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
        // Get data from adoption form
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $birth_date = $_POST['birth_date'];
        $occupation = $_POST['occupation'];
        $company_name = $_POST['company_name'];
        $social_media_profile = $_POST['social_media_profile'];
        $status = $_POST['status'];
        $pronouns = $_POST['pronouns'];
        $adopt_reason = $_POST['adopt_reason'];
        $adopted_before = $_POST['adopted_before'];
        // $alt_contact_first_name = $_POST['alt_contact_first_name'];
        // $alt_contact_last_name = $_POST['alt_contact_last_name'];
        // $alt_contact_relationship = $_POST['alt_contact_relationship'];
        // $alt_contact_phone = $_POST['alt_contact_phone'];
        // $alt_contact_email = $_POST['alt_contact_email'];
        $pet_type = $_POST['pet_type'];
        $specific_animal = $_POST['specific_animal'];
        $ideal_pet = $_POST['ideal_pet'];
        // $building_type = $_POST['building_type'];
        // $renting = $_POST['renting'];
        // $pet_move_plan = $_POST['pet_move_plan'];
        // $household_members = $_POST['household_members'];
        // $household_allergic = $_POST['household_allergic'];
        // $care_responsibility = $_POST['care_responsibility'];
        // $financial_responsibility = $_POST['financial_responsibility'];
        // $vacation_care = $_POST['vacation_care'];
        // $hours_alone = $_POST['hours_alone'];
        // $introduce_pet_plan = $_POST['introduce_pet_plan'];
        // $family_support = $_POST['family_support'];
        // $family_support_explanation = $_POST['family_support_explanation'];
        // $other_pets = $_POST['other_pets'];
        // $past_pets = $_POST['past_pets'];

        // Handle file uploads
        $photo_home = $_FILES['photo_home']['name'];
        $valid_id = $_FILES['valid_id']['name'];

        // Move uploaded files to a folder
        $target_dir = "uploads/";
        $target_file_home = $target_dir . basename($_FILES["photo_home"]["name"]);
        $target_file_id = $target_dir . basename($_FILES["valid_id"]["name"]);

        move_uploaded_file($_FILES["photo_home"]["tmp_name"], $target_file_home);
        move_uploaded_file($_FILES["valid_id"]["tmp_name"], $target_file_id);

        // Insert data into adopt_applications table
        $sql_adoptForm = "INSERT INTO adopt_applications 
    (first_name, last_name, address, phone, email, birth_date, occupation, company_name, social_media_profile, status, pronouns, adopt_reason, adopted_before, pet_type, specific_animal, ideal_pet, photo_home, valid_id) 
    VALUES 
    ('$first_name', '$last_name', '$address', '$phone', '$email', '$birth_date', '$occupation', '$company_name', '$social_media_profile', '$status', '$pronouns', '$adopt_reason', '$adopted_before', '$pet_type', '$specific_animal', '$ideal_pet', '$target_file_home', '$target_file_id')";


        if ($conn->query($sql_adoptForm) === TRUE) {
            echo "<div class='alert alert-success'>Thank you for your adoption application! <br> Your application has been submitted successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql_adoptForm . "<br>" . $conn->error . "</div>";
        }
    }

    // Close database connection
    $conn->close();
?>