<?php
    session_start();
    $logedOut = !isset($_SESSION['status']) || $_SESSION['status'] !== "registered";
    if (!$logedOut) {
        header("Location: ../mainPage/main.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readify | Login</title>
    <link rel="icon" type="image/x-icon" href="../images/logo.svg">

    <link rel="stylesheet" href="styles.css?v=3.0">

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
                        <p id="Wrong2" style="display: none; color: red; text-align: center;">Email or password doesn't exist!</p>

                        <a href="#" id="forgotPassword">Forgot password?</a>
                        <input id="singInOrUp" type="submit"  name="login"  value = "Log in" >

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
        exit();  
    }
        
     if(isset($_POST['login'])){
            $email = trim($_POST['em']);
            $email = strtolower($email);
            $userpassword = trim($_POST['pass']);
            $query = 'Select userEmail, userId, userPass from bookUser where userEmail =\'' . $email . "'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
            $emailExists = false;
            $hashedPassword = $info['userPass'];
            if ($info && password_verify($userpassword, $hashedPassword)) {
                $_SESSION['userId'] = $info['userId'];
                $_SESSION['avatar'] = "../images/LogIn_Images/DogAvatar.png";
                $_SESSION['status'] = "registered";
                $_SESSION['role'] = 'user';
                header("Location: ../mainPage/main.php");
                exit; 
            }   else {
                if(ctype_digit($userpassword)){
                    $query = "Select * from bookAdmin where adminEmail = '{$email}' and adminId = {$userpassword}";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $info = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($info === false){
                        $wrongEmail = true;
                        exit;
                    } else {
                        $_SESSION['adminName'] = "{$info['adminFN']} {$info['adminLN']}";
                        $_SESSION['adminId'] = $info['adminId'];
                        $_SESSION['role'] = 'admin';
                        header("Location: ../adminPage/admin.php");
                    }
                }
                
             else {
                $wrongEmail = true;

            }
            
            }     
     }
    
        if(isset($_POST['sign'])){
            $email = trim($_POST['signUpEmail']);
            $email = strtolower($email);
            $userpassword = trim($_POST['signUpPassword']);
            $userConfirm = trim($_POST['confirmPassword']);
            $hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);
            $joinYear = $currentYear = date("Y");
            $joinMonth = $currentYear = date("m");
            $joinDay = $currentYear = date("d");
            $Avatar = "../images/LogIn_Images/DogAvatar.png";
            $query = "SELECT MAX(userID) AS userId FROM bookUser";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $userId = $result['userId']+1; 
            $query = 'Select userEmail, userPass, userId from bookUser where userEmail =\'' . $email . "'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
            $emailExists = ($stmt->rowCount() > 0) ? true : false;

            if ($stmt->rowCount()==0) {
            $query = "INSERT INTO bookUser 
            VALUES ($userId, '$Avatar', '$email', '$hashedPassword', $joinDay, $joinMonth, $joinYear)";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $_SESSION['userId'] = $userId;
            $_SESSION['Sstatus'] = 1;
            $_SESSION['role'] = 'user';
            header("Location: pref.php");
            exit;
            }
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
                        <p id="Wrong" style="display: none; color: red; text-align: center;">Password mismatch!</p>

                        <input id = "su" type="submit" name="sign"  value="Sign Up">



        
                    </form>
                    <script>
var wrongEmail = <?php echo json_encode($wrongEmail); ?>;
        if(wrongEmail){
            document.getElementById('Wrong2').style.display = 'flex';
        }
</script>
                    <script>
var emailExists = <?php echo json_encode($emailExists); ?>;
    if (emailExists) {
        document.getElementById('Wrong2').style.display = 'flex';
        document.getElementById('loginForm').style.display = 'none';  
        document.getElementById('signUpForm').style.display = 'flex'; 
    }

</script>
                    <p>Already have an account? <a href="#" id="loginLink">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>

</body>

</html>
