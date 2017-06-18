<?php
    require '../partials/db.php';
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
        <link rel="stylesheet" href="../css/style.css"/>
    </head>
    <body>
        <?php if ($_SESSION['loggedin'] === true){ // Show upload page
            ?>
            <div class="spacer-lg_btm"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Side menu -->
                        <div style="position: fixed;">
                            <div>
                                <!-- Logo placeholder icon, NOT final -->
                                <a href="#"><span class="fa fa-file-code-o" style="font-size: 40px; color: #434857;"></span></a>
                            </div>
                            <div class="spacer-sm_btm"></div>
                            
                            <!-- Search input field -->
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            
                            <div class="spacer-sm_btm"></div>
                            
                            <!-- Navigation menu -->
                            <span class="font-md_grey source_sans_pro">INFORMATION</span>
                            <div class="list-group">
                                <a href="../index.php" class="list-group-item">Home</a>
                                <a href="../about.php" class="list-group-item">About</a>
                                <a href="../contact.php" class="list-group-item">Contact</a>
                            </div>
                            <div class="divider-btm"></div>
                            
                            <div class="spacer-sm_btm"></div>
                            
                            <!-- Content menu -->
                            <span class="font-md_grey source_sans_pro">CONTENT</span>
                            <div class="list-group">
                                <a href="upload.php" class="list-group-item active">Upload</a>
                            </div>
                            <div class="divider-btm"></div>
                            
                            <div class="spacer-sm_btm"></div>
                            
                            <!-- Account menu -->
                            <span class="font-md_grey source_sans_pro">ACCOUNT</span>
                            <div class="list-group">
                                <a href="../account/profile.php" class="list-group-item"><?php echo $_SESSION['username']; ?></a>
                                <a href="../account/logout.php" class="list-group-item">Logout</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <span class="font-md_grey source_sans_pro">CODE</span>
                        <h3 class="font-white miriam_libre">Upload</h3>
                        <div class="divider-btm"></div>
                    </div>
                </div>
            </div>
        <?php }else{ // Redirect to home page
            header('location: ../index.php');
        }?>
    </body>
</html>