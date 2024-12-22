<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {

    header("Location: ../LoginPage/Project.php?error=unauthorized");
    exit;

}
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
    if(isset($_POST['rmvBook'])){
            
        $deleteBook = "delete from addToFav where book_ID = {$_POST['rmvBook']} ";
        $stmt = $conn->prepare($deleteBook);  
        $stmt->execute(); 
        $deleteBook = "delete from belongsTo where book_ID = {$_POST['rmvBook']} ";
        $stmt = $conn->prepare($deleteBook);  
        $stmt->execute(); 
        $deleteBook = "delete from book where bookId = {$_POST['rmvBook']} ";
        $stmt = $conn->prepare($deleteBook);  
        $stmt->execute(); 
        $_POST['rmvBook'] = "";
}

        

            ?>