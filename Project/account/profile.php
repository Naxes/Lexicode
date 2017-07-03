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
        <?php if ($_GET['id'] != ""){ // Show profile page
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
                                            // If profile picture is blank use default image, else use uploaded image
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
                                            // If ID is logged in user, allow editing of details
                                            if ($_GET['id'] === $_SESSION['userid']){ ?>
                                                <a href="/Project/account/edit/details.php?id=<?php echo $_SESSION['userid']; ?>"><i class="edit-details fa fa-pencil-square"></i></a>   
                                            <?php }
                                        ?>
                                        <h2 class="font-white font-header"><?php echo $user['username']; ?></h2>
                                        <?php 
                                            // If bio is blank show default message, else show users bio
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
                                        // Show users submissions
                                        $query = $mysqli->query("SELECT * FROM code WHERE codeid = '".$_GET['id']."'");
                                        
                                        // Loop and display all submissions
                                        while ($row = $query->fetch_array()) {
                                            echo "<div class='post content-blackbox'>
                                                <div class='vertical-sm'></div>
                                                <a class='post-title' href='/Project/code/post.php?id=".$row['id']."'><h4 class='font-header' style='margin-bottom: 0;'>".$row['name']."</h4></a>
                                                <span class='language font-grey_lightest font-content'>".$row['language']."</span>";
                                                // If self-submission, allow edit or delete
                                                if ($_GET['id'] === $_SESSION['userid']){
                                                    echo "<a class='edit-submission' href='/Project/account/edit/submission.php?id=".$row['id']."'><i class='fa fa-pencil-square'></i></a>
                                                <a class='delete-submission' href='/Project/account/edit/delete.php?id=".$row['id']."'><i class='fa fa-times-circle'></i></a>";
                                                }
                                        echo    "<a class='post-user' href='/Project/account/profile.php?id=".$row['codeid']."'><span class='font-subheader' style='margin-left: 20px;'>/u/".$row['author']."</span></a>
                                                <div class='vertical-sm'></div>
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
                    <div class="<?php echo $_SESSION['message-type']; ?>">
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