<?php 
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== "registered") {
    header("Location: ../LoginPage/Project.php?error=unauthorized");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {

    header("Location: ../LoginPage/Project.php?error=unauthorized");
    exit;

}


// The rest of your protected page logic goes here


?>
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

    $avatarQuery = "SELECT * from bookUser where userId = {$_SESSION['userId']}";
    $stmt = $conn->prepare($avatarQuery);  
    $stmt->execute(); 
    $info = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['avatar'] = $info['avatar'];
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readify.</title>
    <link rel="icon" type="image/x-icon" href="../images/logo.svg">
    <link rel="stylesheet" href="main.css?v=3.0">
 </head>
<header>
    <nav>
        <a href="">Readify. </a>
       <div class="searchContainer">
        <input type="text" placeholder="Search for a book">
         <div class="menu">
         <div class="catalog">
         <img id="UserAvatar" src="<?php echo $_SESSION['avatar']; ?>">
            <div class="co">
                <div class="containerMinue">
                <a href=""> <img src="../images/catalog/bookmark.svg" alt=""></a>
            <a href=""><img src="../images/catalog/icon-1.svg" alt=""></a>
            <a href="end.php"> <img src="../images/catalog/icon-2.svg" alt="" id="logOut"></a>
            <a href=""><img src="../images/catalog/icon.svg" alt=""></a>
                </div>

            </div>

         </div>
         </div>
        </div>

    </nav>
</header>
<body>
    <div id="onlyForYouCont">
        <div class="title">
            <div class="darkGrey one"></div>
            <div class="darkGrey two"></div>
            <h3>Only for <span>you</span></h3>
            <div class="lightGrey one"></div>
            <div class="lightGrey two"></div>
        </div>

        <div class="books">
            <?php
            $booksQuery = "SELECT DISTINCT bookCover, bookId from belongsTo, book, interestedIn
            where bookID = book_Id and interestedIn.cat_Id = belongsTo.cat_ID and user_ID = " . $_SESSION['userId'] . " limit 30";
            $stmt = $conn->prepare($booksQuery);  
            $stmt->execute(); 
            $books = $stmt->fetchALL(PDO::FETCH_ASSOC);


    foreach ($books as $book) {
        echo "<div class=\"bookCont\" > <input type=\"text\" name=\"b{$book['bookId']}\" value=\"{$book['bookId']}\" style=\"display: none;\">";
     echo "<img src=\"{$book['bookCover']}\" onclick=\"selectButton(this)\" class=\"bookImg\" id= \"b{$book['bookId']}\">";
    $saved = "SELECT book_Id from addToFav where user_ID = {$_SESSION['userId']} and book_Id = {$book['bookId']} ";
    $stmt = $conn->prepare($saved);  
    $stmt->execute(); 
    $exist = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount()==0){
        echo "<img src=\"../images/save/icon.svg\" class=\"unsaved\" onclick=\"addToFav(this)\" id=\"s{$book['bookId']}\"> ";
    } else{
        echo "<img src=\"../images/save/bookmark_filled.svg\" class=\"saved\" onclick=\"addToFav(this)\" id=\"u{$book['bookId']}\"> ";
    }
     echo "</div>";

    }
            #onclick="document.getElementById('myForm').submit();
            ?>
            <form action="" method="POST" id ="addBook"">
            <input type="text" id="add" name="add" style = "display: none;">
            <input type="text" id="rmvB" name="rmvB" style = "display: none;">
            </form>
            
            
            <script>
function addToFav(element) {
    if (element.src.endsWith("icon.svg")) {
        element.src = "../images/save/bookmark_filled.svg";
    } else {
        element.src = "../images/save/icon.svg";
    }
}
document.querySelectorAll('img').forEach(image => {
    image.addEventListener('click', function(event) {

        const imageId = event.target.id;
        if(imageId.startsWith("s")){
            document.getElementById("rmvB").value = "0";
            document.getElementById("add").value = imageId.slice(1);
            const formData = new FormData (document.getElementById("addBook"));
            fetch('index.php', { 
                method: 'POST',
                body: formData
            })
            .then(response => response.text())  // Assuming the server returns text
        .then(data => {
    console.log('Server Response:', data); // Log the server's response
    })
    .catch(error => {
    console.error('Error:', error);
    document.getElementById("addBook").preventDefault();

    });

        } else {
            document.getElementById("add").value = "0";
            document.getElementById("rmvB").value = imageId.slice(1);
            const formData = new FormData (document.getElementById("addBook"));
            fetch('index.php', { 
                method: 'POST',
                body: formData
            })
            .then(response => response.text())  
        .then(data => {
    console.log('Server Response:', data); 
    })
    .catch(error => {
    console.error('Error:', error);
    document.getElementById("addBook").preventDefault();

    });
            

        }
    });
});
            </script>

    <?php 
    ?>


            
        </div>
    </div>

    <section>
    <div id="byOthers">
        <div class="title2">

            <h3>Selected by <span style="color: #1F7AE2;">Others</span></h3>

        </div>
        <img src="../images/avatars/gmail_groups.svg">
        </div>
        <div class="books2 books">
            <?php
            $booksQuery = "SELECT DISTINCT book_Id as bookId, bookCover from addToFav, book
where addToFav.book_Id in (SELECT bookId from belongsTo, book, interestedIn
 where bookID = book_Id and interestedIn.cat_Id = belongsTo.cat_ID and user_ID = {$_SESSION['userId']}) and book.bookId = book_Id";
            $stmt = $conn->prepare($booksQuery);  
            $stmt->execute(); 
            $books = $stmt->fetchALL(PDO::FETCH_ASSOC);


    foreach ($books as $book) {
        echo "<div class=\"bookCont\" > <input type=\"text\" name=\"b{$book['bookId']}\" value=\"{$book['bookId']}\" style=\"display: none;\">";
     echo "<img src=\"{$book['bookCover']}\" onclick=\"selectButton(this)\" class=\"bookImg\" id= \"b{$book['bookId']}\">";
    $saved = "SELECT book_Id from addToFav where user_ID = {$_SESSION['userId']} and book_Id = {$book['bookId']} ";
    $stmt = $conn->prepare($saved);  
    $stmt->execute(); 
    $exist = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount()==0){
        echo "<img src=\"../images/save/icon.svg\" class=\"unsaved\" onclick=\"addToFav(this)\" id=\"s{$book['bookId']}\"> ";
    } else{
        echo "<img src=\"../images/save/bookmark_filled.svg\" class=\"saved\" onclick=\"addToFav(this)\" id=\"u{$book['bookId']}\"> ";
    }
     echo "</div>";

    }
            #onclick="document.getElementById('myForm').submit();
            ?>
            <form action="" method="POST" id ="addBook"">
            <input type="text" id="add" name="add" style = "display: none;">
            <input type="text" id="rmvB" name="rmvB" style = "display: none;">
            </form>
            
            
            <script>
function addToFav(element) {
    if (element.src.endsWith("icon.svg")) {
        element.src = "../images/save/bookmark_filled.svg";
    } else {
        element.src = "../images/save/icon.svg";
    }
}
document.querySelectorAll('img').forEach(image => {
    image.addEventListener('click', function(event) {

        const imageId = event.target.id;
        if(imageId.startsWith("s")){
            document.getElementById("rmvB").value = "0";
            document.getElementById("add").value = imageId.slice(1);
            const formData = new FormData (document.getElementById("addBook"));
            fetch('index.php', { 
                method: 'POST',
                body: formData
            })
            .then(response => response.text())  // Assuming the server returns text
        .then(data => {
    console.log('Server Response:', data); // Log the server's response
    })
    .catch(error => {
    console.error('Error:', error);
    document.getElementById("addBook").preventDefault();

    });

        } else {
            document.getElementById("add").value = "0";
            document.getElementById("rmvB").value = imageId.slice(1);
            const formData = new FormData (document.getElementById("addBook"));
            fetch('index.php', { 
                method: 'POST',
                body: formData
            })
            .then(response => response.text())  
        .then(data => {
    console.log('Server Response:', data); 
    })
    .catch(error => {
    console.error('Error:', error);
    document.getElementById("addBook").preventDefault();

    });
            

        }
    });
});
            </script>

    <?php 
    ?>


            
        </div>
    </div>

    </section>
    
</body>
<footer>
<div class="sections">
    <div class="aboutUs">
        <h1>About Us</h1>
        <p>Readify is dedicated to providing a seamless library experience. Our platform allows you to discover, borrow, and return books with ease. We aim to empower readers and learners from all walks of life by making knowledge more accessible and engaging.</p>
    </div>
    <div class="quickLinks">
        <ul>
            <h1>Quick Links</h1>
            <a href="../homePage/home.html"><li>Home</li></a>
            <a href="../homePage/home.html#whatNew"><li>What's New</li></a>
            <a href="../homePage/home.html#review"><li>Reviews</li></a>
        </ul>
    </div>
    <div class="contactUs">
        <h1>Contact Us</h1>
        <ul>
            <li>Email: Youssef.ashraf16@msa.edu.eg</li>
            <li>Phone: +20 1278043245</li>
            <li>Address: MSA University.</li>
        </ul>
    </div>
</div>
    <p class="copyRight"> &copy;2024 <a href="">Readify.</a>All rights reserved.</p>
    </footer>
</html>