<?php
    require 'includes/db.php';
    session_start();
    
    $active_page = "home";
?>

<!DOCTYPE html>
    <head>
        <title>Home</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        
        <!-- Prism syntax highlighter CSS -->
        <link rel="stylesheet" href="../../node_modules/prismjs/themes/prism-okaidia.css"/>
        
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        
        <!-- Style -->
        <link rel="stylesheet" href="css/output.css"/>
    </head>
    <body>
        <div class="vertical-lg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php include 'includes/navigation.php'; ?>
                </div>

                <div class="col-md-9">
                    <span class="font-grey_light font-header">HOME</span>
                    <h3 class="font-white font-subheader">Home Page</h3>
                </div>
            </div>
        </div>
        <?php
            // Alert if login succeeds
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
        <!-- Prism syntax highlighter JS -->
        <script src="../../node_modules/prismjs/prism.js"></script>
        <script src="../../node_modules/prismjs/components/prism-php.js"></script>
        <script src="../../node_modules/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.js"></script>
    </body>
</html>