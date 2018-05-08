<?php

    require_once ('session.php');
    require_once ('included_functions.php');
    $mysqli = db_connection();

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $hashed_pw = password_encrypt($_POST['pw']);
    $password = $_POST['pw'];
    $dob = $_POST['dob'];

    #Create a unique key for customer account
    do {
        $userID = "user".rand(100,999);
        $checkIDquery = "SELECT * FROM Users WHERE userID = '".$usersID."'";
        $result = $mysqli->query($checkIDquery);
    } while ($result->num_rows > 0);

    #Check to see if email has already been used
    $query = "SELECT * FROM Users ";
    $query .= "WHERE email = '".$email."' ";
    $query .= "LIMIT 1";
    $result = $mysqli->query($query);
    if ($result && $result->num_rows > 0) {
        $_SESSION["message"] = "The email you provided has already been associated with an account.";
        redirect_to("signup.php");
        exit;
    }

    #If email has not been used, perform query to add customer
    $addQuery = "INSERT INTO Users VALUES (";
    $addQuery .= "'".$userID."', ";
    $addQuery .= "'".$fname."', ";
    $addQuery .= "'".$lname."', ";
    $addQuery .= "'".$street."', ";
    $addQuery .= "'".$city."', ";
    $addQuery .= "'".$state."', ";
    $addQuery .= "".$zip.", ";
    $addQuery .= "'".$phone."', ";
    $addQuery .= "'".$email."', ";
    $addQuery .= "'".$hashed_pw."', ";
    $addQuery .= "'".$dob."')";
   

    $result = $mysqli->query($addQuery);
    if (!$result){
        $_SESSION["message"] = "The account can't be created.";
        redirect_to("signup.php");
        exit;
    }

    # Set session values:
    $_SESSION["userID"] = $userID;
    $_SESSION["email"] = $email;
?>

<!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <title>OLEMISS CRICKET CLUB</title> -->
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

<!--//////////////////////////////////   NAVBAR       /////////////////////////////////////////////////// -->
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
             <!-- <li><a href="signup.php">SIGN UP</a></li> -->
             <li><a href="signin.php">LOG IN </a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
<section id="home">
    <div class="container">
      <div class="jumbotron index">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="content">
                <h1 style="font-size:2em">OLEMISS CRICKET CLUB</h1>
                <h3>OXFORD MS 38655 </h3>
                <hr>
                <button class="btn btn-default btn-lg" onclick="return btntest_onclick()"><i class="fa fa-paw fa-fw"></i> PAST TOURNAMENTS  </button>
            </div>
        </div>
    </div>
   </div>
 </div>
</section>

    </body>
</html>