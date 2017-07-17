<?php
    require '../../includes/db.php';
    session_start();
    
    $active_page = "details";
    
    // Escape string to protect against SQL Injection
    $username = $mysqli->escape_string($_POST['username']);
    $email = $mysqli->escape_string($_POST['email']);
    $bio = $mysqli->escape_string($_POST['bio']);
    $password1 = $mysqli->escape_string($_POST['password1']);
    $password2 = $mysqli->escape_string(password_hash($_POST['password1'], PASSWORD_BCRYPT));
    
    // User assoc array
    $query = $mysqli->query("SELECT * FROM users WHERE userid ='".$_SESSION['userid']."'");
    $user = $query->fetch_assoc();
    
    // Change details
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['update'])){
            // Check username exists outside of current login
            $query = $mysqli->query("SELECT * FROM users WHERE (username = '$username' OR email = '$email') AND userid <> '" . $_SESSION['userid'] . "'");

            // If user details are in use, don't allow change
            if($query->num_rows > 0){
                $_SESSION['message-type'] = "error-message";
                $_SESSION['message'] = "Username/Email taken";
            // Else update details
            }else{
                $mysqli->begin_transaction();
                    $mysqli->query("UPDATE users SET username = '$username', bio = '$bio', email = '$email', password = '$password2' WHERE userid = '" . $_SESSION['userid'] . "'");
                    $mysqli->query("UPDATE code SET author = '$username' WHERE codeid = '".$_SESSION['userid']."'");
                $mysqli->commit();
                
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password1;
                
                $_SESSION['message-type'] = "success-message";
                $_SESSION['message'] = "Details updated";
                // Redirect to profile
                header("location: ../profile.php?id=".$_GET['id']."");
                exit;
            }
        }
    }
    
    // Change avatar
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (!isset($_POST['update'])){
            move_uploaded_file($_FILES['profile-pic'] ['tmp_name'], "../../images/".$_FILES['profile-pic'] ['name']);
            $query = $mysqli->query("UPDATE users SET image = '".$_FILES['profile-pic'] ['name']."' WHERE userid = '".$_SESSION['userid']."'");
            
            $_SESSION['message-type'] = "success-message";
            $_SESSION['message'] = "Avatar updated";
            header("location: ../profile.php?id=".$_GET['id']."");
            exit;
        }
    }
?>

<!DOCTYPE html>
    <head>
        <title>Profile | Edit Details</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        
        <!-- Style -->
        <link rel="stylesheet" href="../../css/output.css"/>
    </head>
    <body>
        <?php if ($_SESSION['loggedin'] === true){ // Show edit page
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="content-nav col-1">
                        <?php include '../../includes/content-nav.php' ?>
                    </div>
                    
                    <div class="col-md-10 offset-1">
                        <!-- Account Information -->
                        <div class="container">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-4">
                                    <div class="vertical-lg"></div>
                                    
                                    <h2 class="font-white font-header text-center">Details</h2>
                                    <div class="details content-blackbox">
                                        <form method="post" autocomplete="off">
                                            <!-- Username -->
                                            <div class="container">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label class="font-white" for="username">Username:</label>
                                                        <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username']; ?>" autocomplete="off" required />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Bio -->
                                            <div class="container">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label class="font-white" for="bio">Bio:</label>
                                                        <textarea type="text" class="form-control" name="bio" autocomplete="off" style="resize: none;"><?php echo $user['bio']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Email -->
                                            <div class="container">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label class="font-white" for="email">Email:</label>
                                                        <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email']; ?>" autocomplete="off" required />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Password -->
                                            <div class="container">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label class="font-white" for="password1">Password:</label>
                                                        <input type="password" class="form-control" name="password1" value="<?php echo $_SESSION['password']; ?>" autocomplete="off" required />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Update button -->
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input type="submit" class="btn btn-primary" name="update" value="Update" style="width: 50%;"></input>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>   
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="vertical-lg"></div>
                                    <h2 class="font-white font-header text-center">Avatar</h2>
                                    <div class="profile-img">
                                        <?php 
                                            if ($user['image'] === ""){
                                                echo "<img width='100%' height='100%' src='/Project/images/default.png' alt='Default profile picture'/>";
                                            } else {
                                                echo "<img width='100%' height='100%' src='/Project/images/".$user['image']."' alt='Profile picture'/>";
                                            }
                                        ?>
                                        <div class="vertical-sm"></div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <form class="edit-avatar text-center" method="post" enctype="multipart/form-data">
                                                        <label class="font-white font-subheader" for="file">Change your avatar</label>
                                                        <input id="file" type="file" name="profile-pic" onchange="this.form.submit();" style="opacity: 0; position: absolute;"/>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="account-nav col-1">
                        <?php include '../../includes/account-nav.php'; ?>
                    </div>
                </div>
            </div>
            <?php
                // Alert if login fails
                if (isset($_SESSION['message'])){?>
                    <div class="error-message">
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
            header('location: ../../index.php');
            exit;
        }?>
    </body>
</html>