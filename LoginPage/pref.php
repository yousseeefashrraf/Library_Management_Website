

<?php 
 session_start();
 if($_SESSION['Sstatus'] != 1){
    header("Location: Project.php");

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


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Readify. </title>
    <link rel="stylesheet" href="pref.css">

</head>
<body>
    <form name= "Formconatiner" class="Formconatiner" id="Formconatiner" method="POST" action="" onsubmit="checkValidation(event)">
        <div class="bookDetail">
            <h3>
                Choose your new avatar!
            </h3>
            <input type="text" name = "userAvatar" style="display: none;" id="userAvatar">
            <input name="selectedGenres" id="selectedGenres" style="display: none;">
            <input name="selectAv" id="selectAvatar" style="display: none;">

        <div class="imgCont">
            <img src="../images/avatars/3d_avatar_1.svg" alt="" id="selectAv" onclick="sl(this)">
            <img src="../images/avatars/3d_avatar_14.svg" alt="" id="selectAv" onclick="sl(this)">
            <img src="../images/avatars/3d_avatar_19.svg" alt="" id="selectAv" onclick="sl(this)">
            <img src="../images/avatars/3d_avatar_22.svg" alt="" id="selectAv" onclick="sl(this)">
            <img src="../images/avatars/3d_avatar_23.svg" alt="" id="selectAv" onclick="sl(this)">
            <img src="../images/avatars/32.svg" alt="" id="selectAv" onclick="sl(this)">
        </div>
        </div>
        <div class="genres">
        <div class="secondSection">
        <h3>Choose what you like <br> Read what you love!</h3>

<div class="genreCont">
    <?php
    foreach ($genres as $genre) {
        echo '<input type="button" value="' . $genre['catName'] . '" onclick="selectButton(this)">';
    }
    ?>
</div>

<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $query = "Update bookUser set avatar = '{$_POST['selectAv']}' where userId = {$_SESSION['userId']}";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $userId = $_SESSION['userId'];   
    $_SESSION['avatar'] = $_POST['selectAv'];
    $_SESSION['status'] = "registered";
        $genres = explode(",", $_POST['selectedGenres']);
                foreach ($genres as $genre) {
                    $getCatId = "SELECT catId as c FROM category WHERE catName = '{$genre}'";
                    $stmt = $conn->prepare($getCatId);
                    $stmt->execute();
                    $catID = $stmt->fetch(PDO::FETCH_ASSOC);
    
                    if ($catID) {
                        $insert = "Insert into interestedIn values(" . $userId . ", " . $catID['c'] . ")";
                        $stmt = $conn->prepare($insert);
                        $stmt->execute();
                    }
                }
    
    
   
    header("Location: ../mainPage/main.php"); 
    exit;

   }



    

?>
        </div>
        <button type="submit"> Finish </button">
        </div>
    </form> 
   <script src="pref.js"></script>
</body>
</html>