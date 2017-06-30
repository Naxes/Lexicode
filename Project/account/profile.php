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
        <?php if ($_SESSION['loggedin'] === true && $_GET['id'] != ""){ // Show profile page
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="content-nav col-1">
                        <?php include '../includes/content-nav.php' ?>
                    </div>
                    
                    <div class="col-10 offset-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3">
                                    <div class="vertical-lg"></div>
                                    <div class="profile-img">
                                        <?php 
                                            $query = $mysqli->query("SELECT * FROM users WHERE userid = '" .$_GET['id']."'");
                                            $user = $query->fetch_assoc();
                                            if ($user['image'] === ""){
                                                echo "<img src='/Project/images/default.png' alt='Default profile picture'/>";
                                            } else {
                                                echo "<img src='/Project/images/".$user['image']."' alt='Profile picture'/>";
                                            }
                                        ?>
                                    </div>
                                    <div class="vertical-sm"></div>
                                    <div class="details">
                                        <?php 
                                            if ($_GET['id'] === $_SESSION['userid']){ ?>
                                                <a href="/Project/account/edit/details.php?id=<?php echo $_SESSION['userid']; ?>"><i class="edit-icon fa fa-pencil-square"></i></a>   
                                            <?php }
                                        ?>
                                        <h2 class="font-white font-header"><?php echo $user['username']; ?></h2>
                                        <?php 
                                            if ($user['bio'] === ""){ ?>
                                                <span class="font-grey_light font-content">[No Bio]</span></br>    
                                                <div class="vertical-sm"></div>
                                            <?php } else { ?>
                                                <span class="font-grey_light font-content"><?php echo $user['bio']; ?></span></br>    
                                                <div class="vertical-sm"></div>
                                            <?php }
                                        ?>
                                        <i class="font-white fa fa-envelope"></i> <a href="mailto:<?php echo $user['email']; ?>" class="font-content"><?php echo $user['email']; ?></a>    
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="vertical-lg"></div>
                                    <h2 class="font-white font-header">Submissions</h2>
                                    <?php 
                                        $query = $mysqli->query("SELECT * FROM code WHERE codeid = '".$_GET['id']."'");
                                        
                                        while ($row = $query->fetch_array()){
                                            echo "<div class='content-blackbox'>
                                            <h4 class='font-white font-header'>".$row['name']."</h4>
                                            <h5 class='font-white font-subheader' style='margin-left: 20px;'>by ".$row['author']."</h5>
                                        </div>
                                        <div class='vertical-sm'></div>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="account-nav col-1">
                        <?php include '../includes/account-nav.php' ?>
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