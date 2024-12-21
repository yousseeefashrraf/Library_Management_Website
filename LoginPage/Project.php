
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Readify | Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="../images/logo.svg">
</head>
<body>
    <div class="container">
        <div class="library-image">
            <img src="../images/LogIn_Images/pexels-birgit-held-392791-1046125.jpg" alt="Library">
        </div>
        <div class="login-form">
            <div id="formContainer">
                <!-- Login Form -->
                <div id="loginForm">
                    <div class="header">
                        <div class="header-left">
                            <h1>Readify.</h1>
                            <p>Nice to see you again</p>
                        </div>
                        <div class="header-right">
                            <img src="..\images\LogIn_Images\DogAvatar.png" alt="Icon">
                        </div>
                    </div>
                    <form method = "POST"  novalidate action="">
                        <label for="em">Email</label>
                        <input type="email" id="email" name="em" placeholder="example@gmail.com" required ">
                        <label for="pass">Password</label>
                        <div id="showPass">
                            <input type="password" id="password" name="pass" placeholder="Enter Password" required onkeyup="showPassword()" onblur="showPassword()">
                            <img id="eyeShown" src="../images/LogIn_Images/Eye.png" alt="" style="display: none;" onclick="showPasswordContent()">
                            <img id="eyeOff" src="../images/LogIn_Images/Eye off.png" alt="" style="display: none;" onclick="hidePasswordContent()">
                        </div>
                        <a href="#" id="forgotPassword">Forgot password?</a>
                        <input type="submit"  name="login" id="singInOrUp" value = "Log in" >
    
                    </form>


                    <p>Don't have an account? <a href="#" id="signUpLink">Sign Up</a></p>
                </div>

                <?php 
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
        echo "Connection failed: " . $e->getMessage();  
        exit();  
    }
        try{
            $query = "select * from bookUser where userID = 1000";
            $stmt = $conn->prepare($query);  // Prepare the SQL query
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            echo "error";
        }

        

        if(isset($_POST['login'])){
            $email = trim($_POST['em']);
            $email = strtolower($email);
            $userpassword = trim($_POST['pass']);
            $query = 'Select userEmail, userPass, userId from bookUser where userEmail =\'' . $email . '\' and userPass =\'' . $userpassword . "'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($stmt->rowCount() == 0) {

                echo "<p style='color:red;'>Email or password not found!</p>";

                exit;
            } else {
                header("Location: ../mainPage/main.php"); 
                exit;
            }
    



            header("Location: Project.php"); 
            
        } 
        
                ?>

                <!-- Sign Up Form -->
                <div id="signUpForm" style="display: none;">
                    <div class="header">
                        <div class="header-left">
                            <h1>Readify.</h1>
                            <p>Create your account</p>
                        </div>
                        <div class="header-right">
                            <img src="..\images\LogIn_Images\DogAvatar.png" alt="Icon">
                        </div>
                    </div>
                    <form method = "POST"  novalidate action="">
                        <label for="signUpEmail">Email</label>
                        <input type="email" id="signUpEmail" name="signUpEmail" placeholder="example@gmail.com" required>
                        <label for="signUpPassword">Password</label>
                        <div id="showPass">
                            <input type="password" id="signUpPassword" id = "pass" name="signUpPassword" placeholder="Enter Password" required onkeyup="showPassword()" onblur="showPassword()">
                            <img id="eyeShown2" src="../images/LogIn_Images/Eye.png" alt="" style="display: none;" onclick="showPasswordContent()">
                            <img id="eyeOff2" src="../images/LogIn_Images/Eye off.png" alt="" style="display: none;" onclick="hidePasswordContent()">
                        </div>

                        <label for="confirmPassword">Confirm Password</label>
                            <div id="showPass">
                                <input type="password" id="confirmPassword" id="passconf" name="confirmPassword" placeholder="Confirm Password" required onkeyup="showPassword()" onblur="showPassword()">
                                <img id="eyeShown3" src="../images/LogIn_Images/Eye.png" alt="" style="display: none;" onclick="showConfirmContent()">
                                <img id="eyeOff3" src="../images/LogIn_Images/Eye off.png" alt="" style="display: none;" onclick="hideConfirm()">
                            </div>
                        <input name="sign" type="submit" id="singInOrUp" value="Sign Up">
                    </form>
                    <p>Already have an account? <a href="#" id="loginLink">Sign In</a></p>
                </div>
                <?php

                if(isset($_POST['sign'])){

            $email = trim($_POST['signUpEmail']);
            $email = strtolower($email);
            $userpassword = trim($_POST['signUpPassword']);
            $userConfirm = trim($_POST['confirmPassword']);

            if ($userpassword != $userConfirm) {

                echo "<p style='color:red;'>Password missmatch!</p>";
                exit;
            }

            $query = 'Select userEmail, userPass, userId from bookUser where userEmail =\'' . $email . '\' and userPass =\'' . $userpassword . "'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
            

            if ($stmt->rowCount() != 0) {

                echo "<p style='color:red;'>Email is already taken!</p>";

                exit;
            } else {
                header("Location: pref.php"); 
                exit;
            }
    



            header("Location: Project.php"); 
            
        } 
        ?>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
