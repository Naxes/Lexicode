<?php
    require '../includes/db.php';
    session_start();
    
    $active_page = "post";
    
    /* Search */
    // Search field input
    $search = $mysqli->escape_string($_POST['search']);
    
    // If request method is post
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        // If search field is blank, redirect
        if ($_POST['search'] === ""){
            header('location: ../index.php');
            exit;
        // Else search for content based on user input and redirect
        } else {
            $_GET['search'] = $search;
            // Redirect
            header('location: ../index.php?search='.$_GET['search'].'&page=1');
            exit;    
        }
    // Else do nothing
    } else {
        
    }
?>

<!DOCTYPE html>
    <head>
        <title>Ticket</title>
        
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
        <?php if ($_GET['id'] != "" && $_SESSION['admin'] === "1") { ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="content-nav col-1">
                            <?php include '../includes/content-nav.php'; ?>
                        </div>
        
                        <div class="col-10 offset-1">
                            <div class="vertical-lg"></div>
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <?php
                                        $query = $mysqli->query("SELECT * FROM tickets WHERE id = '".$_GET['id']."'");
                                        
                                        while ($row = $query->fetch_array()) { ?>
                                            <h1 class="font-white font-header text-center">Ticket | <?php echo $row['id']; ?></h1>
                                            <div class='post content-blackbox'>
                                                <div class='vertical-sm'></div>
                                                <a class='post-title' href='/Project/admin/ticket.php?id=<?php echo $row['id']; ?>'><h4 class='font-header' style='margin-bottom: 0;'><?php echo $row['title']; ?></h4></a>
                                                <span class='language font-grey_lightest font-content'><?php echo $row['type']; ?></span>
                                                <div class='vertical-sm'></div>
                                                <h7 class='font-white font-subheader' style='margin-left: 20px;'>Description</h7>
                                                <div class='post-content'>
                                                    <p class='font-white font-content'><?php echo $row['description']; ?></p>
                                                </div>
                                                <div class='vertical-sm'></div>
                                                <h7 class='font-white font-subheader' style='margin-left: 20px;'>Submitted by <a href="/Project/account/profile.php?id=<?php echo $row['userid']; ?>"><?php $username = $mysqli->query("SELECT username FROM users WHERE userid = '".$row['userid']."'"); $user = $username->fetch_array(); echo $user['username']; ?></a></h7>
                                                <div class='vertical-sm'></div>
                                            </div>
                                            <div class='vertical-sm'></div>
                                        <?php }
                                    ?>
                                </div>
                                <div class="col-2"></div>
                            </div>
                        </div>
                        
                        <div class="account-nav col-1">
                            <?php include '../includes/account-nav.php'; ?>
                        </div>
                    </div>
                </div>
            <?php } else {
                header('location: ../index.php');
                exit;
            }
        ?>
    </body>
</html>