<?php
session_start();
$_SESSION['bookId'] = 100;
    $hostname = "l2i9a.h.filess.io";  // Database host
    $database = "Readify_tracemayup";  // Database name
    $port = "3306";                    // MySQL port
    $username = "Readify_tracemayup";  // Database username
    $password = "82a322fb89e4c79d395c2b6f694b1587129141a6"; // Database password

    // Create connection using PDO
    try {
        $dsn = "mysql:host=$hostname;dbname=$database;port=$port";  // DSN (Data Source Name)
        $conn = new PDO($dsn, $username, $password);  // PDO connection
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Set error mode to exception
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();  // Display error message if connection fails
        exit();  // Exit the script if connection fails
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $bookId = $_POST['BookId'] ?? null;
        $_SESSION['bookId'] = $_POST['BookId'] ?? 100;
        if ($bookId) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Data processed successfully',
                'bookId' => $bookId
            ]);
    
            // Send the redirection header
            header("Location: ../book_Info/book_Info.php");
            exit;
        } else {
            echo "Book ID not received.";
        }
    }
  

            ?>