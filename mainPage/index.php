<?php
session_start();
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
    if(isset($_POST['rmvB']) && !($_POST['rmvB']==="1") && ($_POST['add']==="0")){
            
        $deleteBook = "delete from addToFav where user_ID = {$_SESSION['userId']} and book_Id = {$_POST['rmvB']} ";
        $stmt = $conn->prepare($deleteBook);  
        $stmt->execute(); 
        $_POST['add'] = "0";
}
        if(isset($_POST['add']) && !($_POST['add']==="1") && ($_POST['rmvB']==="0")){
            $addBook = "insert into addToFav values({$_SESSION['userId']},{$_POST['add']})";
            $stmt = $conn->prepare($addBook);  
            $stmt->execute(); 
            $_POST['rmvB'] = "0";

        
    } 
  

            ?>