<?php

    require_once ('session.php');
    require_once ('included_functions.php');
    if(logged_in()){
        redirect_to("account.php");
        exit;
    }
    $mysqli = db_connection();

    if (isset($_POST["signinButton"])){
        if (isset($_POST["inputEmail"]) && $_POST["inputEmail"] !== "" &&
            isset($_POST["inputPassword"]) && $_POST["inputPassword"] !== ""){
            //Grab posted values for username and password.
            //IMPORTANT CHANGE:  Unlike in addLogin.php, you will NOT encrypt password
            //Once we check if the username exists, we will do the encryption in
            //the function password_check, which returns true if the passwords match
            $email = $_POST["inputEmail"];
            $password = $_POST["inputPassword"];

            $query = "SELECT * FROM Users ";
            $query .= "WHERE email = '".$email."' ";
            $query .= "LIMIT 1";
            $result = $mysqli->query($query);

            //Username found so now check password
            //If the attempted password matches the database password then set two $_SESSION variables
            if ($result && $result->num_rows > 0){
                $row = $result->fetch_assoc();
                if (password_check($password, $row['hashed_pw'])) {
                    $_SESSION["userID"] = $row["userID"];
                    $_SESSION["email"] = $row["email"];
                    redirect_to("account.php");
                }
                else{
                    $_SESSION["message"] = "Email/Password Not Found";
                    redirect_to("signin.php");
                }
            }
            else{
                $_SESSION["message"] = "Email/Password Not Found";
                redirect_to("signin.php");
            }
        }
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OLEMISS CRICKET CLUB</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <script type="text/javascript" src="stylesheet/sports.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Sorts+Mill+Goudy" rel="stylesheet">

    <link rel="shortcut icon" href="ab.ico" />
    <link rel="stylesheet" type="text/css" href="stylesheet/home.css">
    <link rel="stylesheet" type="text/css" href="stylesheet/navbar.css">

  </head>

    <body>
        <div class="navbar-wrapper">
      <nav class="navbar navbar-inverse navbar-fixed-top bg-primary ">
            <a class="navbar-brand slign-left" href="home.html">OLEMISS CRICKET CLUB </a>
        <div class="container">
          <div class="navbar-header">

               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
               </button>

          </div>
          <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav test">
             <li><a href="home.html">OMCC HOME</a></li>
             <li><a href="#arts">PRACTICE SESSTIONS</a></li>
             <li><a href="#melam">MAGNOLIA TROPHY</a></li>
             <li><a href="#about">CONTACT US</a></li>
             <li><a href="signup.php">SIGN UP</a></li>
             <li><a href="signin.php">LOG IN</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
 <div class="container-fluid">
            <div class="page-header">
            </div> 
                  <h1><div class="text-center">&#10;&#13;</div></h1> 
            
            </div>
<?php
    if (($output = message()) !== null) {
        echo "<br/>";
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-lg-2'></div>";
        echo "<div class='col-lg-8'>";
        echo        $output;
        echo "</div>";
        echo "<div class='col-lg-2'></div>";
        echo "</div>";
        echo "</div>";
}
?>

<div class="container">
    <form action="signin.php" method="post" class="form-signin">
        <fieldset>
            <h2 class="form-signin-heading">Please sign in</h2>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="inputPassword" class="form-control" placeholder="Password" required>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="signinButton">Sign In</button>
        </fieldset>
    </form>
</div> <!-- /container -->


</body>
</html>

<?php
    new_footer('OleMiss Cricket Club', $mysqli);
?>
