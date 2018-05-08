<?php

    require_once ('session.php'); 
    require_once ('included_functions.php');
    verify_login(); $mysqli = db_connection();

    // Set USER ID
    $ID = $_SESSION['userID'];

    // Check if update button has been submitted (edit-form)
    if(isset($_POST['update'])){
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];      
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $query = "UPDATE Users ";
        $query .= "SET street = '".$street."'";
        $query .= ", city = '".$city."'";
        $query .= ", state = '".$state."'";
        $query .= ", zip = ".$zip."";
        $query .= ", phone = '".$phone."'";
        $query .= ", email = '".$email."'";
        $query .= " WHERE userID = '".$ID."'";

        $result = $mysqli->query($query);

        if($result){
            $_SESSION["message"] = "YOUR ACCOUNT INFORMATION HAS BEEN UPDATED!";
        }
        else{
            $_SESSION["message"] = "UPDATE UNSUCCESSFULLY";
        }
    }
    elseif (isset($_POST['changepw'])){
        $checkPasswordQuery = "SELECT * FROM Users ";
        $checkPasswordQuery .= "WHERE userID = '".$ID."'";
        $result = $mysqli->query($checkPasswordQuery);
        $row = $result->fetch_assoc();
        if (password_check($_POST['oldpw'], $row['hashed_pw'])) {
            $newPassword = password_encrypt($_POST['newpw']);
            $updatePasswordQuery = "UPDATE Users ";
            $updatePasswordQuery .= "SET hashed_pw = '".$newPassword."'";
            $result = $mysqli->query($updatePasswordQuery);
            if($result){
                $_SESSION["message"] = "YOUR PASSWORD HAS BEEN CHANGED!";
            }
            else{
                $_SESSION["message"] = "PASSWORD CAN'T BE CHANGED";
            }
        }
        else{
            $_SESSION["message"] = "YOU ENTERED THE WRONG PASSWORD";
        }
    }

    $query = "SELECT * FROM Users ";
    $query .= "WHERE userID = '".$ID."' LIMIT 1";

    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
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
             <li><a href="home.html#arts">PRACTICE SESSTIONS</a></li>
             <li><a href="home.html#melam">MAGNOLIA TROPHY</a></li>
             <li><a href="home.html#about">CONTACT US</a></li>
             <li><a href="signup.php">SIGN UP</a></li>
             <li><a href="signin.php">LOGIN</a></li>
             <li><a href="account.php">MY ACCOUNT</a></li>
             <li><a href="signout.php">LOGOUT</a></li>             
            </ul>
          </div>
        </div>
      </nav>
    </div>

<body data-spy="scroll" data-target="#myScrollspy" data-offset="15">


<div class="container-fluid">
    <div class="page-header">
        <h1><div class="text-center">My Account</div></h1>
    </div>
    <br/>
</div>

<div class="container">
    <div class="row">
        <nav class="col-lg-3" id="myScrollspy">
            <div class="navbar-header">
                <button type="button" class="no-float navbar-toggle" data-toggle="collapse" data-target="#accountNavbar">
                    <span class="glyphicon glyphicon-collapse-down" style="color: #c9302c; font-size: 25px"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="accountNavbar">
            <ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="160" id="sideBar">
                <li><a href="#section1">Account Overview</a></li>
                <li><a href="#section2">Edit Account</a></li>
                <li><a href="#section3">Change Password</a></li>
                <li><a href="#section4">Delete Account</a></li>
            </ul>
            </div>
        </nav>

        <div class="col-lg-9">
            <div id="section1">
                <h1 style="color: #245580">Account Overview</h1>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                <?php
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Name</strong></td><td>".$row['fname']." ".$row['lname']."</td></tr>";
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Address</strong></td><td>".$row['street']."</td></tr>";
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>City</strong></td><td>".$row['city']."</td></tr>";
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>State</strong></td><td>".$row['state']."</td></tr>";
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>ZIP Code</strong></td><td>".$row['zip']."</td></tr>";
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Phone</strong></td><td>".$row['phone']."</td></tr>";
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Email</strong></td><td>".$row['email']."</td></tr>";
                    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Birthdate</strong></td><td>".$row['dob']."</td></tr>";
                    
                ?>
                    </tbody>
                </table>
            </div>
            
            <div id="section2">
                <hr>
                <h1 style="color: #245580"> Edit Account</h1>
                <p>Your name, birth date and email address cannot be changed!</p>
                <p>Please make sure to enter information in correct format <span class="glyphicon glyphicon-arrow-down"></span></p>
                <br>

                <?php
                    $result = $mysqli->query($query);
                    $row = $result->fetch_assoc();
                ?>

                <form action="account.php" method="post" id="edit-form" class="form-horizontal">
                    <fieldset>
                        <!-- First Name -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">First Name</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <?php
                                        echo "<input  name='fname' class='form-control'  type='text' value = '".$row['fname']."' readonly>";
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Last Name</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <?php
                                        echo "<input  name='lname' class='form-control'  type='text' value = '".$row['lname']."' readonly>";
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- DOB -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Birthdate</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-gift"></i></span>
                                    <?php
                                        echo "<input  name='dob' class='form-control'  type='date' value = '".$row['DOB']."' readonly>";
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Street Address -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Street Address</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                    <?php
                                        echo "<input  name='street' class='form-control'  type='text' value = '".$row['street']."'>";
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- City -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">City</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                    <?php
                                        echo "<input  name='city' class='form-control'  type='text' value = '".$row['city']."'>";
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- State -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">State</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                    <select name="state" class="form-control selectpicker">
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
                                                if($item == $row['state']){
                                                    echo "<option selected>".$item."</option>";
                                                }
                                                else{
                                                    echo "<option>".$item."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- ZIP -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">ZIP Code</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                    <?php
                                        echo "<input  name='zip' class='form-control'  type='text' value = '".$row['zip']."'>";
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Phone Number</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <?php
                                        echo "<input  name='phone' class='form-control'  type='text' value = '".$row['phone']."'>";
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email Address</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <?php
                                        echo "<input  name='email' class='form-control'  type='email' value = '".$row['email']."'readonly>";
                                    ?>
                                </div>
                            </div>
                       </div>
                                       
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-lg-5 control-label"></label>
                            <div class="col-lg-2">
                                <button type="submit" name="update" id="submitButton" class="btn btn-lg btn-primary btn-block">Update</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
                <br>
            </div>
            <div id="section3">
                <hr>
                <h1 style="color: #245580"> Change Password</h1>
                <br><br>
                <form action="account.php" method="post" id="pw-change-form" class="form-horizontal">
                    <fieldset>
                        <!-- Old Password -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Old Password</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input  name="oldpw" class="form-control"  type="password">
                                </div>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">New Password</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input  name="newpw" class="form-control"  type="password">
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-lg-5 control-label"></label>
                            <div class="col-lg-2">
                                <button type="submit" name="changepw" id="submitButton" class="btn btn-lg btn-primary btn-block">Change</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div id="section4">
                <hr>
                <h1 style="color: #245580"> Delete Account</h1>
                <p>Please contact us if you have any problems with our sport club !</p>
                <p>We would love to see you next season!!</p>
                <p><a href="home.html#about">CONTACT US</a></p>
                <br>
                <form action="signout.php" method="post" id="pw-change-form" class="form-horizontal">
                    <fieldset>
                        <!-- Retype Password -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Retype Password</label>
                            <div class="col-lg-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input  name="confirm_pw" class="form-control"  type="password">
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-lg-5 control-label"></label>
                            <div class="col-lg-2">
                                <button type="submit" name="delete" id="submitButton" class="btn btn-lg btn-danger btn-block">Delete</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- CODE FOR FORM VALIDATOR -->
<script type="text/javascript">
    // First 2 lines which start with $ is different
    // from those in file signup.php
    // This is to validate MULTIPLE FORMS
    $('form').each(function() {
        $(this).bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Please supply your email address'
                        },
                        emailAddress: {
                            message: 'Please supply a valid email address'
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'Please supply your phone number'
                        },
                        phone: {
                            country: 'US',
                            message: 'Please supply a vaild phone number with area code'
                        }
                    }
                },
                street: {
                    validators: {
                        stringLength: {
                            min: 8,
                        },
                        notEmpty: {
                            message: 'Please supply your street address'
                        }
                    }
                },
                city: {
                    validators: {
                        stringLength: {
                            min: 4,
                        },
                        notEmpty: {
                            message: 'Please supply your city'
                        }
                    }
                },
                state: {
                    validators: {
                        notEmpty: {
                            message: 'Please select your state'
                        }
                    }
                },
                zip: {
                    validators: {
                        notEmpty: {
                            message: 'Please supply your zip code'
                        },
                        zipCode: {
                            country: 'US',
                            message: 'Please supply a valid zip code'
                        }
                    }
                },               
                oldpw: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your old password'
                        }
                    }
                },
                newpw: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your old password'
                        },
                        stringLength: {
                            min: 8,
                            message: 'Your new password needs to be at least 8 characters'
                        }
                    }
                },
                confirm_pw: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your password for security reason'
                        }
                    }
                }
            }
        })
    });

    Smooth Scrolling
    $(document).ready(function(){
        /* smooth scrolling sections */
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });

    // Shadowed nav-bar
    $(function(){
        var navbar = $('.navbar');
        $(window).scroll(function(){
            if($(window).scrollTop() <= 80){
                navbar.css('box-shadow', 'none');
            } else {
                navbar.css('box-shadow', '0px 5px 10px rgba(0, 0, 0, 0.4)');
            }
        });
    })

</script>


</body>
</html>

<?php
    new_footer('OleMiss Cricket Club ', $mysqli);
?>