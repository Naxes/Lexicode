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
        <div class="container-fluid">
            <div class="row">
                <div class="content-nav col-1">
                    <?php include 'includes/content-nav.php'; ?>
                </div>

                <div class="col-md-10 offset-1">
                    <div class="vertical-lg"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <?php 
                                    $query = $mysqli->query("SELECT * FROM code");
                                    
                                    while ($row = $query->fetch_array()) {
                                        echo "<div class='content-blackbox'>
                                            <h4 class='font-white font-header'>".$row['name']."</h4>
                                            <a href='/Project/account/profile.php?id=".$row['codeid']."'><span class='font-white font-subheader' style='margin-left: 20px;'>by ".$row['author']."</span></a>
                                        </div>
                                        <div class='vertical-sm'></div>";
                                    }
                                ?>
                            </div>
                            <div class="col-4">
                                <div class="content-blackbox">
                                    <form method="post" class="search" autocomplete="off">
                                        <input type="text" class="form-control" placeholder="Search"/>
                                        <i class="search-icon font-white fa fa-search"></i>
                                    </form>
                                </div>
                                <div class="vertical-sm"></div>
                                <div class="upload-link">
                                    <a href="/Project/code/upload.php">
                                        <div class="content-blackbox text-center">
                                            <span class="font-white font-subheader">Submit new code</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="vertical-sm"></div>
                                <h6 class="font-white font-content">NEW USERS</h6>
                                <div class="user-list">
                                    <div class="content-blackbox">
                                        <?php 
                                            $query = $mysqli->query("SELECT * FROM users WHERE (admin_rights = 0) ORDER BY id DESC LIMIT 10");
                                            
                                            while ($row = $query->fetch_array()){
                                                echo "<a href='/Project/account/profile.php?id=".$row['userid']."'>";
                                                echo "<div class='container-fluid'>
                                                        <div class='vertical-sm'></div>
                                                        <div class='row'>
                                                            <div class='col-3'>";
                                                                if ($row['image'] === ""){
                                                                    echo "<img src='/Project/images/default.png' alt='Default profile picture'/>";
                                                                } else {
                                                                    echo "<img src='/Project/images/".$row['image']."' alt='Profile picture'/>";
                                                                }
                                                    echo    "</div>
                                                            <div class='col-9'>";
                                                                if ($row['userid'] === $_SESSION['userid']){
                                                                    echo "<span class='font-white font-content' style='line-height: 50px;'>".$row['username']." (You)</span>";
                                                                } else {
                                                                    echo "<span class='font-white font-content' style='line-height: 50px;'>".$row['username']."</span>";
                                                                }
                                                    echo    "</div>
                                                        </div>
                                                        <div class='vertical-sm'></div>
                                                </div>";
                                                echo "</a>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="vertical-sm"></div>
                                <h6 class="font-white font-content">ADMINISTRATORS</h6>
                                <div class="admin-list">
                                    <div class="content-blackbox">
                                        <?php 
                                            $query = $mysqli->query("SELECT * FROM users WHERE admin_rights = 1");
                                            
                                            while ($row = $query->fetch_array()){
                                                echo "<a href='/Project/account/profile.php?id=".$row['userid']."'>";
                                                echo "<div class='container-fluid'>
                                                        <div class='vertical-sm'></div>
                                                        <div class='row'>
                                                            <div class='col-3'>";
                                                                if ($row['image'] === ""){
                                                                    echo "<img src='/Project/images/default.png' alt='Default profile picture'/>";
                                                                } else {
                                                                    echo "<img src='/Project/images/".$row['image']."' alt='Profile picture'/>";
                                                                }
                                                    echo    "</div>
                                                            <div class='col-9'>";
                                                                if ($row['userid'] === $_SESSION['userid']){
                                                                    echo "<span class='font-white font-content' style='line-height: 50px;'>".$row['username']." (You)</span>";
                                                                } else {
                                                                    echo "<span class='font-white font-content' style='line-height: 50px;'>".$row['username']."</span>";
                                                                }
                                                    echo    "</div>
                                                        </div>
                                                    <div class='vertical-sm'></div>
                                                </div>";
                                                echo "</a>";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="account-nav col-md-1">
                    <?php include 'includes/account-nav.php'; ?>
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