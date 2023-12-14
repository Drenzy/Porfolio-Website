<?php
// Include the database connection
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];

    // Validate input
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
    } else {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO Login (Username, PasswordHash, Email) VALUES (?, ?, ?)");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param("sss", $username, $hashedPassword, $email);
        $stmt->execute();

        // Check if the user was successfully registered
        if ($stmt->affected_rows > 0) {
            echo "Registration successful!";
        } else {
            echo "Registration failed. Please try again.";
        }

        $stmt->close();
    }

    // Close the connection
    $conn->close();
}
?>
