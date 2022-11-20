<?php 

session_start();
include 'templates/head.php';
include 'templates/nav.php';

$userErr = $passErr = "";
$username = $password = "";
$errCount = 0;
?>

<!DOCTYPE html>
<html>
<head>
   
    <title>Login</title>
    <style>

        .make-it-center{
            margin: auto;
            width: 50%;
        }

        body{
            background: #eeeaea;
            margin: auto;
            width: 50%;
            border: 1px solid #3e3c3c;
            padding: 20px;

        }

        .lefterr{
            margin-left: -10%;
        }

        .required:after {
            content:"*";
            color: red;
        }
        .error{
            color: red;
        }

        /* The sidebar menu */
        .sidenav {
            height: 100%; /* Full-height: remove this if you want "auto" height */
            width: 220px; /* Set the width of the sidebar */
            position: fixed; /* Fixed Sidebar (stay in place on scroll) */
            z-index: 1; /* Stay on top */
            top: 0; /* Stay at the top */
            left: 0;
            background-color: #111; /* Black */
            overflow-x: hidden; /* Disable horizontal scroll */
            padding-top: 20px;
        }

        /* The navigation menu links */
        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
        }

        /* When you mouse over the navigation links, change their color */
        .sidenav a:hover {
            color: #f1f1f1;
        }

    </style>
</head>
<body>


    <div class="donor-info make-it-center">
    <h2>Login</h2>
    <form method="post" action="LoginAction.php" enctype="multipart/form-data" novalidate>
        Username: <input type="text" name="username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>">
        <span class="error">* <?php echo $userErr;?></span>
        <br><br>
        Password: <input type="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
        <span class="error">* <?php echo $passErr;?></span>
        <br><br>
        <input type="checkbox" id="rmbm" name="rmbm" value="True">
        <label for="rmbm"> Remember Me</label><br><br>




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








        <input type="submit" name="submit" class="button1" value="Log in"><br>



        <a href="/MVC_AHMS/forgot.php"> <span>Forgot Password?</span> </a><hr>



    <style>
        .button {
          background-color: #4CAF50; /* Green */
          border: none;
          color: white;
          padding: 16px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          transition-duration: 0.4s;
          cursor: pointer;
        }

        button:hover {background-color: #e7e7e7;}

        .button {
          background-color: #66B2FF;
          color: #0000CC;
          border: 2px solid #555555;
        }

        .button:hover {
          background-color: #99CCFF;
          color: white;
        }
        </style>
        </head>
        <body>


        <a href="/MVC_AHMS/Registration.php" class="button" >Create New Account.</a>
                


    </form>

    </div>


</body>
<?php include 'templates/footer.php';?>
</html>