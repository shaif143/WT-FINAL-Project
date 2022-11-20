<?php
include 'templates/nav.php';
session_start();
include 'templates/head.php';




// define variables and set to empty values
$nameErr = $emailErr = $degreeErr = $genderErr = $userErr = $passErr = $cnfrmPassErr = $dobErr = "";
$name = $email = $gender = $username = $password = $cnfrmPass = "";
$dob = $successmsg = "";
$dobdd = $dobmm = $dobyy = "";
$errCount = 0;
$message = '';
$error = '';
if(isset($_POST["submit"]))  {


    $isValid = true;
    $name = check_input($_POST['name']);
    $email = check_input($_POST['email']);
    $username = check_input($_POST['username']);
    $password = check_input($_POST['password']);
    $cnfrmPass = check_input($_POST['cnfrmPass']);
    
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $errCount = $errCount + 1;
        $_SESSION['name_err_msg'] = "Name can not be empty";
         $isValid = false;

    } else {
        $name = check_input($_POST["name"]);
        $wcount = str_word_count($name);
        if ($wcount < 2 ) {
            // code...
            $nameErr = "Minimum 2 words required";
            $errCount = $errCount + 1;
            $_SESSION['name_err_msg'] = "Minimum 2 words required";
            $isValid = false;
        }

        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]/", $name)) {
            $nameErr = "Name must start with a letter!";
            $name ="";
            $errCount = $errCount + 1;
            $_SESSION['name_err_msg'] = "Name must start with a letter.";
            $isValid = false;
        }

        if (!preg_match("/^[a-zA-Z_\-. ]*$/",$name)) {
            $nameErr = "Only letters, period and white space allowed";
            $name="";
            $errCount = $errCount + 1;
            $_SESSION['name_err_msg'] = "Only letters, period and white space allowed";
      
            $isValid = false;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $errCount = $errCount + 1;
        $_SESSION['email_err_msg'] = "Email can not be empty";
      
      $isValid = false;
    } else {
        $email = check_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $email="";
            $errCount = $errCount + 1;
            $_SESSION['email_err_msg'] = "Email format error";
      
      $isValid = false;
        }
    }


    if (empty($_POST["username"])) {
        $userErr = "Username is required";
        $errCount = $errCount + 1;
        $_SESSION['username_err_msg'] = "Username can not be empty";
      
      $isValid = false;
    } else {
        $username = $_POST["username"];

        if (strlen($username) <2 ) {
            // code...
            $userErr = "Minimum 2 characters required";
            $errCount = $errCount + 1;
            $_SESSION['username_err_msg'] = "Minimum 2 characters required.";
      
      $isValid = false;
        }

        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9a-zA-Z_\-.]*$/", $username)) {
            $userErr = "Username can contain alpha numeric characters, period, dash or underscore only!";
            $username ="";
            $errCount = $errCount + 1;
            $_SESSION['username_err_msg'] = "Only numbers, letters and white space is allowed";
      
      $isValid = false;
        }

    }


    if (empty($_POST["password"])) {
        $passErr = "Password is required";
        $errCount = $errCount + 1;
        $_SESSION['password_err_msg'] = "Password can not be empty";
      
      $isValid = false;
    } else {

        $password = check_input($_POST["password"]);
        $cnfrmPass = check_input($_POST["cnfrmPass"]);

        if (empty($cnfrmPass)) {
            // code...
            $confrmPassErr = "Confirm password is required";
            $errCount = $errCount + 1;
            $_SESSION['cnfrmPass_err_msg'] = "Confirm password can not be empty";
      
      $isValid = false;
        } else {
            if ($password != $cnfrmPass) {
                // code...
                $confrmPassErr = "Confirm password is didn't match with password!";
                $errCount = $errCount + 1;
                $_SESSION['cnfrmPass_err_msg'] = "Confirm password did not match.";
      
      $isValid = false;
            }
        }


        if (strlen($password) < 8 ) {
            // code...
            $passErr = "Minimum 8 characters required";
            $errCount = $errCount + 1;
            $_SESSION['password_err_msg'] = "Minimum 8 characters required.";
      
      $isValid = false;
        }

        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[%$#@]).+$/", $password)) {
            /*
            ^ starts the string
                 (?=.*[a-z]) Atleast a lower case letter
                 (?=.*[A-Z]) Atleast an upper case letter
                 (?!.* ) no space
                 (?=.*\d%$#@) Atleast a digit and atleast one of the specified characters.
                 .{8,16} between 8 to 16 characters
            */
            $passErr .= " Password must contain atleast a digit, a lower case and an upper case letter, atleast one of the [%$#@] and no space.";
            $password ="";
            $errCount = $errCount + 1;
            $_SESSION['password_err_msg'] = "Password must contain atleast a digit, a lower case and an upper case letter, atleast one of the [%$#@] and no space.";
      
      $isValid = false;
        }

    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        $errCount = $errCount + 1;
        $_SESSION['gender_err_msg'] = "Gender should be selected";
      
      $isValid = false;
    } else {
        $gender = check_input($_POST["gender"]);
    }

    if (empty($_POST["dob"])) {
        $dobErr = "Date of Birth is required";
        $errCount = $errCount + 1;
        $_SESSION['dob_err_msg'] = "DOB should be selected";
      
      $isValid = false;
    } else {
        $dob = $_POST["dob"];
    }


    if($errCount > 0) {
        echo "<span class='error'>One or more error occurred!</span>";
        header("Location: Registration.php");
    } else {
        $conn = new mysqli('localhost','root','','ahms');
        if($conn->connect_error)
        {
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
        } 
        else 
        {
        $stmt = $conn->prepare("insert into reg(name, email, username, password, gender, dob) values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $username, $password, $gender, $dob);
        $execval = $stmt->execute();
        echo $execval;
        echo "Registration successfully...";
        header("Location: Login.php");
        $stmt->close();
        $conn->close();
    }
    }
}
function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>