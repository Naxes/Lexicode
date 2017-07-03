<?php
    require 'includes/db.php';
    session_start();
    
    // Search field
    $search = $mysqli->escape_string($_POST['search']);
    
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $_GET['search'] = $search;
        
        // Redirect
        header('location: index.php?search='.$_GET['search'].'');
        exit;
    } else {
        
    }
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

                <div class="col-10 offset-1">
                    <div class="vertical-lg"></div>
                    <div class="row">
                        <div class="col-8">
                            <?php
                                // Order by
                                if ($_GET['sort'] === "old"){
                                    // Oldest
                                    $query = $mysqli->query("SELECT * FROM code ORDER BY id ASC");  
                                } else if ($_GET['sort'] === "new"){
                                    // Newest (Also default)
                                    $query = $mysqli->query("SELECT * FROM code ORDER BY id DESC");    
                                } else {
                                    // Default
                                    $query = $mysqli->query("SELECT * FROM code ORDER BY id DESC");
                                }
                                
                                // Search field
                                if ($_GET['search'] != ""){
                                    $query = $mysqli->query("SELECT * FROM code WHERE name LIKE '%".$_GET['search']."%' || language = '".$_GET['search']."'");
                                } else {
                                    // No change
                                }
                                
                                // Loop and display every row
                                while ($row = $query->fetch_array()) {
                                    echo "<div class='post content-blackbox'>
                                        <div class='vertical-sm'></div>
                                        <a class='post-title' href='/Project/code/post.php?id=".$row['id']."'><h4 class='font-header' style='margin-bottom: 0;'>".$row['name']."</h4></a>
                                        <span class='language font-grey_lightest font-content'>".$row['language']."</span>
                                        <a class='post-user' href='/Project/account/profile.php?id=".$row['codeid']."'><span class='font-subheader' style='margin-left: 20px;'>/u/".$row['author']."</span></a>
                                        <div class='vertical-sm'></div>
                                    </div>
                                    <div class='vertical-sm'></div>";
                                }
                            ?>
                        </div>
                        <?php include 'includes/search.php'; ?>
                    </div>
                    <div class="vertical-lg"></div>
                </div>
                
                <div class="account-nav col-1">
                    <?php include 'includes/account-nav.php'; ?>
                </div>
            </div>
        </div>
        <?php
            // Alert if login succeeds
            if (isset($_SESSION['message'])){?>
                <div class="<?php echo $_SESSION['message-type']; ?>">
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