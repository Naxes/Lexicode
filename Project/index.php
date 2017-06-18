<?php
    require 'partials/db.php';
    session_start();
    
    $active_page = "home";
?>

<!DOCTYPE html>
    <head>
        <title>Home</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        
        <!-- Style -->
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body>
        <div class="spacer-lg_btm"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php include 'partials/navigation.php'; ?>
                </div>

                <div class="col-md-9">
                    <span class="font-md_grey source_sans_pro">HOME</span>
                    <h3 class="font-white miriam_libre">Latest</h3>
                    <div class="divider-btm"></div>
                </div>
            </div>
        </div>
        <?php
            // Alert if login fails
            if (isset($_SESSION['message'])){?>
                <div class="alert alert-success" style="position: absolute; right: 0; bottom: 0; margin: 0 10px 10px 0;">
                    <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                    ?>
                </div> 
            <?php }else { // Display nothing
             
            }
        ?>
    </body>
</html>