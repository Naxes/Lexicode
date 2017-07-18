<?php
    require '../includes/db.php';
    session_start();
    
    $active_page = "profile";
    
    // Support ticket
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['send'])){
            if ($_SESSION['loggedin'] === true){
                $title = $mysqli->escape_string($_POST['title']);
                $description = $mysqli->escape_string($_POST['description']);
                $type = $_POST['type'];
                
                $query = $mysqli->query("INSERT INTO tickets (title, description, type, userid, adminid)
                VALUES ('$title', '$description', '$type', '".$_SESSION['userid']."', '".$_GET['id']."')");
                
                if ($query){
                    // Success message
                    $_SESSION['message-type'] = "success-message";
                    $_SESSION['message'] = "Support ticket sent";
                    header('location: ../index.php');
                    exit;
                } else {
                    // Error message
                    $_SESSION['message-type'] = "error-message";
                    $_SESSION['message'] = "Could not send support ticket";
                    header('location: ../index.php');
                    exit;   
                }   
            } else {
                // Error message
                $_SESSION['message-type'] = "error-message";
                $_SESSION['message'] = "Log in to contact support";
                header('location: ../index.php');
                exit;    
            }
        }
    }
    
    /* Pagination */
    // Amount of items per page
    $limit = 5;
    // If a page is set in the URL, equal that page
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    // Else page is the first page
    } else {
        $page = 1;
    }
    
    $start = ($page - 1) * $limit;
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
                                    <?php
                                        // Get user profile based on ID of row
                                        $query = $mysqli->query("SELECT * FROM users WHERE userid = '" .$_GET['id']."'");
                                        $user = $query->fetch_assoc();
                                        
                                    ?>
                                    <div class="profile-img">
                                        <?php
                                            // If user has no image, use default image
                                            if ($user['image'] === ""){ ?>
                                                <img src='/Project/images/default.png' alt='Default profile picture'/>
                                            <?php } else { // Else use uploaded image ?>
                                                <img src='/Project/images/<?php echo $user['image'] ?>' alt='Profile picture'/>
                                            <?php }
                                        ?>
                                    </div>
                                    <div class="vertical-sm"></div>
                                    <!-- User bio and email -->
                                    <div class="details">
                                        <?php
                                            // If ID is logged in user, allow editing of details
                                            if ($_GET['id'] === $_SESSION['userid']){ ?>
                                                <a href="/Project/account/edit/details.php?id=<?php echo $_SESSION['userid']; ?>"><i class="edit-details fa fa-pencil-square"></i></a>   
                                            <?php }
                                        ?>
                                        <h2 class="font-white font-header"><?php echo $user['username']; ?></h2>
                                        <?php 
                                            // If bio is blank show default message
                                            if ($user['bio'] === ""){ ?>
                                                <span class="font-grey_light font-content">[No Bio]</span></br>    
                                                <div class="vertical-sm"></div>
                                            <?php } else { // Else show users bio ?>
                                                <span class="font-grey_light font-content"><?php echo $user['bio']; ?></span></br>    
                                                <div class="vertical-sm"></div>
                                            <?php }
                                        ?>
                                        <i class="font-white fa fa-envelope"></i> <a href="mailto:<?php echo $user['email']; ?>" class="font-content"><?php echo $user['email']; ?></a>    
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="vertical-lg"></div>
                                    <?php if ($user['admin_rights'] === "0"){ ?>
                                        <h2 class="font-white font-header">Submissions</h2>
                                        <?php
                                            // Show users submissions
                                            $query = $mysqli->query("SELECT * FROM code WHERE codeid = '".$_GET['id']."' ORDER BY id DESC LIMIT $start, $limit");
                                            
                                            if($query->num_rows <= 0){ ?>
                                                <div class="content-blackbox">
                                                    <div class="vertical-sm"></div>
                                                    <h4 class="font-white font-header text-center">Nothing Submitted</h4>
                                                    <div class="vertical-sm"></div>
                                                </div>
                                            <?php } else {
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
                                                <!-- Bottom Pagination -->
                                                <div class="content-blackbox">
                                                    <?php 
                                                        // Pagination
                                                        $count = $mysqli->query("SELECT COUNT(*) FROM code WHERE codeid = '".$_GET['id']."'");
                                                        $row = $count->fetch_array();
                                                        $total_records = $row[0];  
                                                        $total_pages = ceil($total_records / $limit);
                                                        if (isset($_GET['sort'])){
                                                            $pagLink = "<div class='pagination'>";  
                                                            for ($i=1; $i<=$total_pages; $i++) {  
                                                                $pagLink .= "<li class='page-item'><a class='page-link' href='/Project/account/profile.php?id=".$_GET['id']."&page=".$i."'>".$i."</a></li>";  
                                                            };  
                                                            echo $pagLink . "</div>";     
                                                        } else {
                                                            $pagLink = "<div class='pagination'>";  
                                                            for ($i=1; $i<=$total_pages; $i++) {
                                                                $pagLink .= "<li class='page-item'><a class='page-link' href='/Project/account/profile.php?id=".$_GET['id']."&page=".$i."'>".$i."</a></li>";  
                                                            };  
                                                            echo $pagLink . "</div>";     
                                                        }
                                                    ?>
                                                </div>
                                            <?php }
                                        ?>
                                    <?php } else if ($_SESSION['admin'] === "1") { ?>
                                        <h2 class="font-white font-header">Tickets</h2> 
                                        <?php 
                                            // Show support tickets
                                            $query = $mysqli->query("SELECT * FROM tickets WHERE adminid = '".$_GET['id']."'");
                                            
                                            if ($query->num_rows <= 0){ ?>
                                                <div class="content-blackbox">
                                                    <div class="vertical-sm"></div>
                                                    <h4 class="font-white font-header text-center">No Tickets</h4>
                                                    <div class="vertical-sm"></div>
                                                </div>    
                                            <?php } else {
                                                while ($row = $query->fetch_array()){ ?>
                                                    <div class="post content-blackbox">
                                                        <div class="vertical-sm"></div>
                                                        <a class='post-title' href='/Project/admin/ticket.php?id=<?php echo $row['id']; ?>'><h4 class='font-header' style='margin-bottom: 0;'><?php echo $row['title']; ?></h4></a>
                                                        <span class='language font-grey_lightest font-content'><?php echo $row['type']; ?></span>
                                                        <?php if ($_GET['id'] === $_SESSION['userid']){ ?>
                                                            <a class='check-ticket' href='/Project/admin/ticket_complete.php?id=<?php echo $row['id']; ?>'><i class='fa fa-check'></i></a>
                                                        <?php } ?>
                                                        <div class="vertical-sm"></div>
                                                    </div>
                                                    <div class="vertical-sm"></div>
                                                <?php }    
                                            }
                                        ?>
                                    <?php } else { ?>
                                        <h2 class="font-white font-header">Support</h2>
                                        <h5 class="font-white font-subheader">Issue? Log a support ticket!</h5>
                                        <div class="content-blackbox">
                                            <form method="post" autocomplete="off">
                                                <!-- Issue title -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="title">Title:</label>
                                                            <input type="text" class="form-control" name="title" autocomplete="off" required></input>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Issue description -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="description">Describe your problem:</label>
                                                            <textarea type="text" class="form-control" name="description" autocomplete="off" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Issue type -->
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="type">Type of issue:</label>
                                                            <select class="form-control" name="type" required>
                                                                <option value="">Problem with...</option>
                                                                <option>Submission</option>
                                                                <option>Account</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="vertical-sm"></div>
                                                
                                                <!-- Send button -->
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <input type="submit" class="btn btn-primary" name="send" value="Send"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>    
                                    <?php } ?>
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