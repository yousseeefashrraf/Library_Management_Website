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
            $query = "select * from bookUser where userID = 1000";
            $stmt = $conn->prepare($query);  // Prepare the SQL query
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result){
                $_SESSION["username"] = $result['userEmail'];
                $_SESSION["password"] = $result['userPass'];
            }
        } catch (PDOException $e){
            echo "error";
        }

        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readify.</title>
    <link rel="icon" type="image/x-icon" href="../images/logo.svg">
    <link rel="stylesheet" href="main.css">
 </head>
<header>
    <nav>
        <a href="">Readify. </a>
       <div class="searchContainer">
        <input type="text" placeholder="Search for a book">
         <img id="UserAvatar" src="<?php echo $result['avatar']; ?>" /></div>

    </nav>
</header>
<body>
    <div id="onlyForYouCont">
        <div class="title">
            <div class="darkGrey one"></div>
            <div class="darkGrey two"></div>
            <h3>Only for you</h3>
            <div class="lightGrey one"></div>
            <div class="lightGrey two"></div>
        </div>
        <div class="books"></div>
    </div>
</body>
</html>