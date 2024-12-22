<?php
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {

        header("Location: ../LoginPage/Project.php?error=unauthorized");
        exit;

    }
    $hostname = "l2i9a.h.filess.io"; 
    $database = "Readify_tracemayup";  // Database name
    $port = "3306";                    // MySQL port
    $username = "Readify_tracemayup";  // Database username
    $password = "82a322fb89e4c79d395c2b6f694b1587129141a6"; // Database password
    
    $email = $userpassword = "";
    $error = "";
    try {
        $dsn = "mysql:host=$hostname;dbname=$database;port=$port"; 
        $conn = new PDO($dsn, $username, $password);  // PDO connection
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    } catch (PDOException $e) {
        exit();  
    }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css?v=2.0">
</head>

<header>
<nav>
        <a href="">Readify. </a>
       <div class="searchContainer">
         <div class="menu">
         <div class="catalog">
         <img id="UserAvatar" src="../images/avatars/32.svg">
            <div class="co">
                <div class="containerMinue">

            <a href="../mainPage/end.php"> <img src="../images/catalog/icon-2.svg" alt="" id="logOut"></a>
                </div>

            </div>

         </div>
         </div>
        </div>

    </nav>
    <div class="hdr">
    <div class="txt">
    <h1>Hello,<br> <span><?php echo $_SESSION['adminName']; ?></span></h1>
    <h3>Available books: </h3>
    <a href="../insertBook/book.php">Add a book</a>
    </div>
    <img src="rb_2149436178.png" alt="">
    </div>

</header>
<body>
    <form id="removeBook" method = "POST" style="display: none;">
        <input type="text" name="rmvBook" id="rmvBook">
    </form>
    <div class="books">
    <?php
                $query = "select * from book";
                $stmt = $conn->prepare($query);  // Prepare the SQL query
                $stmt->execute();
                $books = $stmt->fetchALL(PDO::FETCH_ASSOC);
    foreach ($books as $book) {
        echo "<div class=\"book\" id=\"b{$book['bookId']}\" >
            <h4>{$book['bookTitle']}</h4> <p>#{$book['bookId']}</p> <p>by {$book['authorFN']} {$book['authorLN']}</p> <img src=\"cancel.svg\" id=\"c{$book['bookId']}\">
        </div>";
    }



    
    ?>

        
    </div>
    <script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('img').forEach(image => {
        image.addEventListener('click', function(event) {
            const imageId = event.target.id;

            if (imageId.startsWith("c")) {
                const bookId = imageId.slice(1); // Extract book ID
                const inputField = document.getElementById("rmvBook");

                if (inputField) {
                    inputField.value = bookId;

                    const form = document.getElementById("removeBook"); 
                    const formData = new FormData(form);

                    fetch('removeBook.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.text())
                        .then(data => {
                            console.log('Server Response:', data);
                            document.getElementById("b" + bookId).style.display = 'none';
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                } else {
                    console.error("Input field with ID 'rmvBook' not found.");
                }
            }
        });
    });
});


        </script>
</body>
</html>