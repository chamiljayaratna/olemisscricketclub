<?php
 require_once ('session.php');
    require_once ('included_functions.php');
    if(logged_in()){
        redirect_to("account.php");
        exit;
    }
    $mysqli = db_connection();
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
             <li><a href="signin.php">LOGIN</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>

     <div class="container-fluid">
            <div class="page-header">
            </div> 
                  <h1><div class="text-center">&#10;&#13;NEW PLAYER SIGNUP</div></h1> 
            
            </div>
        <!-- Print Alert if there's a message -->
             <?php
            if (($output = message()) !== null) {
                echo "<br/><br/><br/><br/>";
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
            else{
                echo "<br><br>";
            }
        ?> 

        
            <form action="welcome.php" method="post" id="signup-form" class="form-horizontal">
                <fieldset>
                    <!-- First Name -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">First Name</label>
                        <div class="col-lg-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input  name="fname" placeholder="First Name" class="form-control"  type="text">
                            </div>
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Last Name</label>
                        <div class="col-lg-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input  name="lname" placeholder="Last Name" class="form-control"  type="text">
                            </div>
                        </div>
                    </div>

                    <!-- Birthdate -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Birthdate</label>
                        <div class="col-lg-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-gift"></i></span>
                                <input  name="dob" placeholder="YYYY-MM-DD" class="form-control"  type="date">
                            </div>
                        </div>
                        <!--<div class="col-lg-4 date">
                            <div class="input-group input-append date" id="datePicker">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input type="date" class="form-control" name="date" />
                            </div>
                        </div>-->
                    </div>

                    <!-- Street Address -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Street Address</label>
                        <div class="col-lg-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input  name="street" class="form-control"  type="text">
                            </div>
                        </div>
                    </div>

                    <!-- City -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">City</label>
                        <div class="col-lg-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input  name="city" class="form-control"  type="text">
                            </div>
                        </div>
                    </div>

                    <!-- State -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">State</label>
                        <div class="col-lg-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                <select name="state" class="form-control selectpicker" >
                                    <option value=" "  selected disabled>Please select your state</option>
<?php
$states = array(
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'DC'=>'District of Columbia',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming',
);
foreach ($states as $item){
    echo "<option>".$item."</option>";
}
?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- ZIP -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">ZIP Code</label>
                        <div class="col-lg-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input  name="zip" class="form-control"  type="text">
                            </div>
                        </div>
                    </div>

                    <!-- Phone Number  -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Phone Number</label>
                        <div class="col-lg-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                <input  name="phone" class="form-control"  type="text">
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Email Address</label>
                        <div class="col-lg-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input  name="email" placeholder="You will use this email to log in" class="form-control"  type="email">
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Password</label>
                        <div class="col-lg-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input  name="pw" class="form-control"  type="password">
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-lg-5 control-label"></label>
                        <div class="col-lg-2">
                            <button type="submit" name="submitButton" id="submitButton" class="btn btn-lg btn-primary btn-block">Sign up</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>


        

    </body>
