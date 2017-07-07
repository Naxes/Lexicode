<?php
    require '../includes/db.php';
    session_start();
    
    $active_page = "admin";
?>

<!DOCTYPE html>
    <head>
        <title>Control Panel</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        <!-- Prism syntax highlighter CSS -->
        <link rel="stylesheet" href="../../../node_modules/prismjs/themes/prism-okaidia.css"/>
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        <!-- Style -->
        <link rel="stylesheet" href="../css/output.css"/>
    </head>
    <body>
        <?php if ($_SESSION['admin'] === "1"){ ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="content-nav col-1">
                            <?php include '../includes/content-nav.php'; ?>
                        </div>
        
                        <div class="col-10 offset-1">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <div class="vertical-md"></div>
                                    <h1 class="font-white text-center"><i class="fa fa-pencil"></i></h1>
                                    <h2 class="font-white font-content text-center">Users</h2>
                                    <div class="vertical-md"></div>
                                    <table class="table table-inverse">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Partner Rights</th>
                                                <th>Admin Rights</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <?php
                                            $query = $mysqli->query("SELECT * FROM users");
                                            
                                            while ($row = $query->fetch_array()){ ?>
                                                <tr>
                                                    <th><?php echo $row['id']; ?></th>
                                                    <th><?php echo $row['username']; ?></th>
                                                    <th><?php echo $row['email']; ?></th>
                                                    <th><?php echo $row['partner_rights']; ?></th>
                                                    <th><?php echo $row['admin_rights']; ?></th>
                                                    <th><a href="/Project/admin/edit/user.php?id=<?php echo $row['id']; ?>"><i class="edit-details fa fa-pencil-square"></i></a></th>
                                                </tr>   
                                            <?php }
                                        ?>
                                    </table>
                                    <div class="vertical-lg"></div>
                                </div>
                                <div class="col-2"></div>
                            </div>
                        </div>
                        
                        <div class="account-nav col-1">
                            <?php include '../includes/account-nav.php'; ?>
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
            <?php } else {
                header('location: ../index.php');
                exit;
            }
        ?>
    </body>
</html>