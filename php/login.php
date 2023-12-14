<?php
// Include the database connection
include('connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM Login WHERE Username=?");

    // Check for errors during the preparation of the statement
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If a matching user is found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user["PasswordHash"];

        // Verify the entered password with the stored hash
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, redirect to index.html
            header("Location: https://nikolajhartwich.dk/index.html");
            exit(); // Ensure that no further code is executed after the redirect
        } else {
            echo "Invalid username or password!";
        }
    } else {
        echo "Invalid username or password!";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection (Note: You might want to close the connection at the end of your script)
//$conn->close();
?>