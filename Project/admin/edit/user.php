<?php
    require '../../includes/db.php';
    session_start();
    
    $active_page = "admin";
    
    $username = $mysqli->escape_string($_POST['username']);
    $email = $mysqli->escape_string($_POST['email']);
    $partner_rights = $_POST['partner_rights'];
    $admin_rights = $_POST['admin_rights'];
    
    // Update
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['update'])){
            // Check username exists outside of current login
            $query = $mysqli->query("SELECT * FROM users WHERE (username = '$username' OR email = '$email') AND id <> '".$_GET['id']."'");
            $row = $query->fetch_array();
            
            // If user details are in use, don't allow change
            if ($query->num_rows > 0){
                $_SESSION['message-type'] = "error-message";
                $_SESSION['message'] = "Username/Email taken";
            // Else check if partner and admin rights aren't both set
            } else {
                // If partner and admin rights are set, don't allow change
                if ($partner_rights == "1" && $admin_rights == "1") {
                    $_SESSION['message-type'] = "error-message";
                    $_SESSION['message'] = "User cannot be an admin/sponsored at once";    
                // Else update details
                } else {
                    $update = $mysqli->query("UPDATE users SET username = '$username', email = '$email', partner_rights = '$partner_rights', admin_rights = '$admin_rights' WHERE id = '".$_GET['id']."'");
                    $_SESSION['message-type'] = "success-message";
                    $_SESSION['message'] = "User updated";
                    header('location: ../control-panel.php');
                    exit;
                }    
            }
        }
    }
?>

<!DOCTYPE html>
    <head>
        <title>Control Panel | User</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        <!-- Style -->
        <link rel="stylesheet" href="../../css/output.css"/>
    </head>
    <body>
        <?php if ($_SESSION['admin'] === "1"){ ?>
            <div class="container-fluid">
                    <div class="row">
                        <div class="content-nav col-1">
                            <?php include '../../includes/content-nav.php'?>
                        </div>
                        
                        <div class="col-10 offset-1">
                            <!-- User form -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <?php 
                                            $query = $mysqli->query("SELECT * FROM users WHERE id = '".$_GET['id']."'");
                                            $row = $query->fetch_array();
                                        ?>
                                        <div class="vertical-md"></div>
                                        <h1 class="font-white text-center"><i class="fa fa-pencil"></i></h1>
                                        <h2 class="font-white font-content text-center">User | <?php echo $row['username']; ?></h2>
                                        <div class="vertical-md"></div>
                                        
                                        <div class="content-blackbox">
                                            <form method="post" autocomplete="off">
                                                <!-- Username -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="username">Username:</label>
                                                            <input type="text" class="form-control" name="username" autocomplete="off" value ="<?php echo $row['username']; ?>" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Email -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="email">Email:</label>
                                                            <input type="text" class="form-control" name="email" autocomplete="off" value ="<?php echo $row['email']; ?>" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Partner Rights -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="partner_rights">Partner Rights:</label>
                                                            <select class="form-control" name="partner_rights" required>
                                                                <option value="">Please select</option>
                                                                <option <?php if ($row['partner_rights'] === "0") { echo "selected = 'selected'"; } ?>>0</option>
                                                                <option <?php if ($row['partner_rights'] === "1") { echo "selected = 'selected'"; } ?>>1</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Admin Rights -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="admin_rights">Admin Rights:</label>
                                                            <select class="form-control" name="admin_rights" required>
                                                                <option value="">Please select</option>
                                                                <option <?php if ($row['admin_rights'] === "0") { echo "selected = 'selected'"; } ?>>0</option>
                                                                <option <?php if ($row['admin_rights'] === "1") { echo "selected = 'selected'"; } ?>>1</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="vertical-sm"></div>
                                                
                                                <!-- Update -->
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input type="submit" class="btn btn-primary" name="update" value="Update"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="vertical-lg"></div>
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="account-nav col-1">
                            <?php include '../../includes/account-nav.php'; ?>
                        </div>
                    </div>
                </div>
                <?php
                    // If message isset, display message
                    if (isset($_SESSION['message'])){?>
                        <div class="<?php echo $_SESSION['message-type']; ?>">
                            <div class="message-content">
                                <?php 
                                    echo $_SESSION['message']; 
                                    unset($_SESSION['message']);
                                ?>
                            </div>
                        </div> 
                    <?php }else { // Else display nothing
                     
                    }
                ?>
        <?php }else{ // Redirect to home page
            header('location: ../../index.php');
            exit;
        }?>
    </body>
</html>