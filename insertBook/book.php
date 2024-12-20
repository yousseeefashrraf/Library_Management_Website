<?php 
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
        session_start();
        try{
            $query = "select catName from category";
            $stmt = $conn->prepare($query);  // Prepare the SQL query
            $stmt->execute();
            $genres = $stmt->fetchALL(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            echo "error";
        }

        ?>




<!DOCTYPE html>
<html lang="en">
<head>

    <script src="book.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin page | Add new book.</title>
    <link rel="stylesheet" href="book.css">

</head>
<body>
    <form name= "Formconatiner" class="Formconatiner" id="Formconatiner" method="POST" action="" onsubmit="checkValidation(event)">
        <div class="bookDetail">
            <h3>
                Add new book
            </h3>
            <div class="formContainer">
                <div class="singleElement">
                <label for="Btitle" >Book title:</label>
                <input type="text" id="Btitle" name="Btitle" required>
                </div>
                <div class="singleElement">
                <label for="Bcover" >Book cover:</label>
                <input type="url" id= "Bcover" name="Bcover" required>
                </div>
                <div class="twoElements">

                <label for="Author">Author name:</label>
                <div class = "nameCont">
                <input type="text" placeholder = "First name" id= "Author" id="fname" name="FN" required >
                <input type="text" placeholder = "Last name" id= "Author" id="lname" name="LN" required>
                </div>
                </div>
                <div class="singleElement">
                <label for="YOP">Year of publish:</label>
                <input type="date" id="YOP" required name="YOP">
                </div>


                <div class="singleElement">

                <label for="des">Description:</label>
                <textarea id="des" name="des" required ></textarea>     
                </div>
                <input name="selectedGenres" id="selectedGenres" style="display: none;">
            </div>
        </div>
        <div class="genres">
        <div class="secondSection">
        <h3>Select categories</h3>

<div class="genreCont">
    <?php
    foreach ($genres as $genre) {
        echo '<input type="button" value="' . $genre['catName'] . '" onclick="selectButton(this)">';
    }
    ?>
</div>

<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $isSet = 0;
    if (isset($_POST["Btitle"])) {
        $title = $_POST["Btitle"];
        $isSet = 1;
    } else {
        $isSet = 0;
    }
    if (isset($_POST["Bcover"])) {
        $cover = $_POST["Bcover"];
        $isSet = 1;
    } else {
        $isSet = 0;
    }
    if (isset($_POST["FN"])) {
        $AFN = $_POST["FN"];
        $isSet = 1;
    } else {
        $isSet = 0;
    }
    if (isset($_POST["LN"])) {
        $ALN = $_POST["LN"];
        $isSet = 1;
    } else {
        $isSet = 0;
    }
    if (isset($_POST["YOP"])) {
        $year = date("Y", strtotime($_POST["YOP"]));
        $isSet = 1;
    } else {
        $isSet = 0;
    } 
    if (isset($_POST["des"])) {
        $des = $_POST["des"];
        $isSet = 1;
    } else {
        $isSet = 0;
    }

    $query = "INSERT INTO book (bookTitle, yearOfPublish, authorFN, authorLN, bookCover, bookDes) 
              VALUES (:title, :year, :AFN, :ALN, :cover, :des)";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':AFN', $AFN);
    $stmt->bindParam(':ALN', $ALN);
    $stmt->bindParam(':cover', $cover);
    $stmt->bindParam(':des', $des);

    $stmt->execute();

   if($isSet == 1){
    $query = "SELECT MAX(bookID) AS maxBookID FROM book";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $bookID = $result['maxBookID'];   
        $genres = explode(",", $_POST['selectedGenres']);
                foreach ($genres as $genre) {
                    $getCatId = "SELECT catID FROM category WHERE catName = :catName";
                    $stmt = $conn->prepare($getCatId);
                    $stmt->bindParam(':catName', $genre, PDO::PARAM_STR);
                    $stmt->execute();
                    $catID = $stmt->fetch(PDO::FETCH_ASSOC);
    
                    if ($catID) {
                        $insert = "INSERT INTO belongsTo (book_ID, cat_ID) VALUES (:bookID, :catID)";
                        $stmt = $conn->prepare($insert);
                        $stmt->bindParam(':bookID', $bookID, PDO::PARAM_INT);
                        $stmt->bindParam(':catID', $catID['catID'], PDO::PARAM_INT);
                        $stmt->execute();
                    }
                }
    }
    
   
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();

   }



    

?>
        </div>
        <button type="submit"> Finish </button">
        </div>
    </form> 

</body>
</html>