<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the target directory for uploads
    $targetDirectory = "uploads/";

    // Generate a unique filename for the uploaded song
    $fileName = uniqid() . "_" . basename($_FILES["song"]["name"]);
    $targetFile = $targetDirectory . $fileName;

    // Check if the file is a valid audio file
    $allowedExtensions = array("mp3", "ogg");
    $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (in_array($fileExtension, $allowedExtensions)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["song"]["tmp_name"], $targetFile)) {
            // File uploaded successfully
            // Now, you can store the file information in your database if needed
            $artist = $_POST["artist"];
            $title = $_POST["title"];

            // Perform database operations as needed
            // Example: Insert the file information into a database

            // Redirect to a success page or back to the upload form
            header("Location: upload_success.php");
            exit();
        } else {
            // Error moving the uploaded file
            echo "Error uploading file.";
        }
    } else {
        // Invalid file type
        echo "Invalid file type. Please upload an MP3 or OGG file.";
    }
} else {
    // Redirect to the upload form if accessed directly without a POST request
    header("Location: upload_form.php");
    exit();
}
?>
