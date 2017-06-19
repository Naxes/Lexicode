<?php
    require '../includes/db.php';
    session_start();
    
    $active_page = "profile";
?>

<!DOCTYPE html>
    <head>
        <title>Profile</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        
        <!-- Style -->
        <link rel="stylesheet" href="../css/output.css"/>
    </head>
    <body>
        <?php if ($_SESSION['loggedin'] === true){ // Show profile page
            ?>
            <div class="vertical-lg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php include '../includes/navigation.php' ?>
                    </div>
                    
                    <div class="col-md-9">
                        <span class="font-grey_light font-header">PROFILE</span>
                        <h3 class="font-white font-subheader">My Account</h3>
                        
                        <div class="vertical-lg"></div>
                    
                        <!-- Account Information -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="avatar">
                                        <span class="fa fa-user"></span>
                                    </div>
                                    
                                    <div class="vertical-sm"></div>
                                    
                                    <div class="details">
                                        <h2><?php echo $_SESSION['username']; ?> <a href="/Project/account/edit/details.php" class="fa fa-pencil-square"></a></h2>
                                        <span class="fa fa-envelope"> <span class="font-white font-content"><?php echo $_SESSION['email']; ?></span></span>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="font-white font-subheader">Submissions.</h5>
                                    <div class="content-blackbox">
                                        <h2 class="font-blue font-content text-center">No Submissions.</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                // Alert if details changed
                if (isset($_SESSION['message'])){?>
                    <div class="success-message">
                        <div class="message-content">
                            <?php 
                                echo $_SESSION['message']; 
                                unset($_SESSION['message']);
                            ?>
                        </div>
                    </div> 
                <?php }else { // Display nothing
                 
                }
            ?>
        <?php } else{ // Redirect to home page
            header('location: ../index.php');
        }?>
    </body>
</html>