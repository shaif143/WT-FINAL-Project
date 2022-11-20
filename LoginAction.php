<?php include 'templates/nav.php';?>

<?php
session_start();
// define variables and set to empty values
$userErr = $passErr = "";
$username = $password = "";
$errCount = 0;
$username = $_POST['username'];
$password = $_POST['password'];

if (isset($_SESSION['uname'])) {
    header('Location: dashboard.php');

} else{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
        $userErr = "Username is required";
        $errCount = $errCount + 1;
    } else {
        $username = check_input($_POST["username"]);

        if (strlen($username) <2 ) {
            // code...
            $userErr = "Minimum 2 characters required";
            $errCount = $errCount + 1;
        }elseif (!preg_match("/^[a-zA-Z_\-.]*$/", $username)) {
            $userErr = "Username can contain alpha numeric characters, period, dash or underscore only!";
            $username ="";
            $errCount = $errCount + 1;
        } else{
            if (isset($_POST['rmbm'])) {
                $time = time();
                setcookie('username', $username, $time + 120);
                setcookie('password', $password, $time + 120);
            }
        }

    }

    if (empty($_POST["password"])) {
        $passErr = "Password is required";
        $errCount = $errCount + 1;
    } else {
        $password = check_input($_POST["password"]);
    }

    if (strlen($password) <8 ) {
        // code...
        $passErr = "Minimum 8 characters required";
        $errCount = $errCount + 1;
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
    }

    if ($errCount < 1){
        session_start();
        $time = time();
        if (isset($_POST['rmbm'])) {
            setcookie('username', $username, $time + 60);
            setcookie('password', $password, $time + 60);
        }

            $isValid = false;
            
            $con = new mysqli("localhost", "root", "", "ahms");

            if ($con->connect_error) {
              die("Connection failed: " . $con->connect_error);
            }else{
                $stmt = $con->prepare("select * from reg where username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt_result = $stmt->get_result();
                if($stmt_result->num_rows > 0){
                    $data = $stmt_result->fetch_assoc();
                    if($data['password'] === $password){
                         echo "Thanks for logging Mr. $item->name ... success!!";
                        $_SESSION['uname'] = $username;
                        header('Location: dashboard.php');
                    }
                }
                else{
                    $_SESSION['global_msg'] = "No record(s) found. Please contact with the administrator";
                header("Location: Login.php");                
            }
            }

            
       

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