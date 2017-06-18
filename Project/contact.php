<?php
    require 'partials/db.php';
    session_start();
    
    $active_page = "contact";
?>

<!DOCTYPE html>
    <head>
        <title>Contact</title>
        
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
                    <span class="font-md_grey source_sans_pro">CONTACT</span>
                    <h3 class="font-white miriam_libre">Email</h3>
                    <div class="divider-btm"></div>
                </div>
            </div>
        </div>
    </body>
</html>