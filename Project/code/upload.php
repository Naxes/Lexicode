<?php
    require '../includes/db.php';
    session_start();
    
    $active_page = "upload";
?>

<!DOCTYPE html>
    <head>
        <title>Upload</title>
        
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
        <?php if ($_SESSION['loggedin'] === true){ // Show upload page
            ?>
            <div class="vertical-lg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php include '../includes/navigation.php'; ?>
                    </div>

                    <div class="col-md-9">
                        <span class="font-grey_light font-header">CODE</span>
                        <h3 class="font-white font-subheader">Upload</h3>
                        <div class="divider-btm"></div>
                    </div>
                </div>
            </div>
        <?php }else{ // Redirect to home page
            header('location: ../index.php');
        }?>
    </body>
</html>