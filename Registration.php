<?php

session_start();
include 'templates/head.php';
include 'templates/nav.php';
// define variables and set to empty values
$nameErr = $emailErr = $degreeErr = $genderErr = $userErr = $passErr = $confrmPassErr = $dobErr = "";
$name = $email = $gender = $username = $password = $cnfrmPass = "";
$dob = $successmsg = "";
$dobdd = $dobmm = $dobyy = "";
$errCount = 0;
$message = '';
$error = '';
?>
 




<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <h3 align="">Register a New Account</h3><br />
    
    <form method="post" action="RegistrationAction.php" enctype="multipart/form-data" novalidate> 

        <?php
        if(isset($error))
        {
            echo $error;
        }
        ?>
        <br />
        <label>Name</label>  <span class="error">* <?php echo $nameErr;?></span>
        <input type="text" name="name" placeholder=" At least two word" class="form-control" value="<?php echo $name;?>" /> <br/>

        <?php echo isset($_SESSION['name_err_msg']) ? $_SESSION['name_err_msg'] : "" ?>

    <br><br>
        <label>E-mail</label> <span class="error">* <?php echo $emailErr;?></span>
        <input type="text" name = "email" placeholder="example@gmail.com" class="form-control" value="<?php echo $email;?>" /><br />

        <?php echo isset($_SESSION['email_err_msg']) ? $_SESSION['email_err_msg'] : "" ?>

    <br><br>

        <label>User Name</label>  <span class="error">* <?php echo $userErr;?></span>
        <input type="text" name = "username" placeholder="specialchars not allowed" class="form-control" value="<?php echo $username;?>" /><br />
        <?php echo isset($_SESSION['username_err_msg']) ? $_SESSION['username_err_msg'] : "" ?>

    <br><br>

        <label>Password</label>  <span class="error">* <?php echo $passErr;?></span>
        <input type="password" name = "password" placeholder="min8UpLowNumSpChar" class="form-control" /><br />

        <?php echo isset($_SESSION['password_err_msg']) ? $_SESSION['password_err_msg'] : "" ?>

    <br><br>
        <label>Confirm Password</label>  <span class="error">* <?php echo $confrmPassErr;?></span>
        <input type="password" name = "cnfrmPass" placeholder="min8UpLowNumSpChar" class="form-control" /><br />

        <?php echo isset($_SESSION['cnfrmPass_err_msg']) ? $_SESSION['cnfrmPass_err_msg'] : "" ?>

    <br><br>

        <fieldset>
            <legend>Gender</legend>  <span class="error">* <?php echo $genderErr;?></span>
            <input type="radio" id="male" name="gender" value="male" <?php if ($gender === 'male'){ echo 'checked';}?> >
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" <?php if ($gender === 'female'){ echo 'checked';}?> >
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="other" <?php if ($gender === 'other'){ echo 'checked';}?> >
            <label for="other">Other</label><br>
            <?php echo isset($_SESSION['gender_err_msg']) ? $_SESSION['gender_err_msg'] : "" ?>


            <legend>Date of Birth:</legend>  <span class="error">* <?php echo $dobErr;?></span>
            <input type="date" name="dob" value="<?php echo $dob;?>"> <br><br>
        </fieldset>
        <?php echo isset($_SESSION['dob_err_msg']) ? $_SESSION['dob_err_msg'] : "" ?>







        <style>
            .button {
              background-color: #FFFFFF; 
              border: none;
              color: white;
              padding: 16px 32px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 1600px;
              margin: 4px 2px;
              transition-duration: 0.4s;
              cursor: pointer;
            }

            .button1 {
              background-color: #3399FF; 
              color: black; 
              border: 12px solid #3399FF;
            }

            .button1:hover {
              background-color: #0080FF; 
              color: black; 
              border: 12.5px solid #0080FF;
            }




</style>


        <input type="submit" name="submit" class="button1" value="Register" class="btn btn-info" /><br />

    </form>
</div>
<br />
</div>
</body>
<?php include 'templates/footer.php';?>
</html>
