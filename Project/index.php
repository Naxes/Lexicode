<?php
    require 'includes/db.php';
    session_start();
    
    /* Search */
    // Search field input
    $search = $mysqli->escape_string($_POST['search']);
    
    // If request method is post
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        // If search field is blank, redirect
        if ($_POST['search'] === ""){
            header('location: index.php');
            exit;
        // Else search for content based on user input and redirect
        } else {
            $_GET['search'] = $search;
            // Redirect
            header('location: index.php?search='.$_GET['search'].'&page=1');
            exit;    
        }
    // Else do nothing
    } else {
        
    }
    
    /* Pagination */
    // Amount of items per page
    $limit = 8;
    // If a page is set in the URL, equal that page
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    // Else page is the first page
    } else {
        $page = 1;
    }
    
    $start = ($page - 1) * $limit;
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
                            <div class="content-blackbox">
                                <?php
                                    // If logged in, welcome user
                                    if ($_SESSION['loggedin'] === true){ ?>
                                        <div class="vertical-sm"></div>
                                        <span class="font-white font-content">Welcome <?php echo $_SESSION['username']; ?></span>
                                        <div class="vertical-sm"></div>
                                    <?php } else { // Else ask user to sign up or sign in ?>
                                        <div class="vertical-sm"></div>
                                        <span class="font-white font-content">Hey! Why not <a href="/Project/account/register.php">sign up</a> or <a href="/Project/account/login.php">sign in</a>?</span>
                                        <div class="vertical-sm"></div>    
                                    <?php }
                                ?>    
                            </div>
                            <div class="vertical-sm"></div>
                            <!-- Sponsored content -->
                            <?php
                                if (isset($_GET['search'])){
                                    $query = $mysqli->query("SELECT * FROM code WHERE name LIKE '%".$_GET['search']."%' || language = '".$_GET['search']."' AND sponsored = 1 ORDER BY RAND() LIMIT 1");     
                                } else {
                                    $query = $mysqli->query("SELECT * FROM code WHERE sponsored = 1 ORDER BY RAND() LIMIT 1");
                                }
                                
                                while ($row = $query->fetch_array()){ ?>
                                    <div class='vertical-sm'></div>
                                    <div class="divider-line"></div>
                                    <div class="vertical-sm"></div>
                                    <div class='post-sponsor'>
                                        <div class='vertical-sm'></div>
                                        <a class='post-title' href='/Project/code/post.php?id=<?php echo $row['id']; ?>'><h4 class='font-header' style='margin-bottom: 0;'><?php echo $row['name']; ?></h4></a>
                                        <span class='language font-grey_lightest font-content'><?php echo $row['language']; ?></span>
                                        <span class='sponsor font-content'>Sponsored</span>
                                        <a class='post-user' href='/Project/account/profile.php?id=<?php echo $row['codeid']; ?>'><span class='font-subheader' style='margin-left: 20px;'>/u/<?php echo $row['author']; ?></span></a>
                                        <div class='vertical-sm'></div>
                                    </div>
                                    <div class='vertical-sm'></div>
                                    <div class="divider-line"></div>
                                    <div class="vertical-sm"></div>
                                <?php }
                            ?>
                            <div class="vertical-sm"></div>
                            <!-- Regular content -->
                            <?php
                                // If sort in the URL = old, order content ASC
                                if ($_GET['sort'] === "old"){
                                    // Oldest
                                    $query = $mysqli->query("SELECT * FROM code ORDER BY id ASC LIMIT $start, $limit");  
                                // Else if sort in the URL = new, order content DESC
                                } else if ($_GET['sort'] === "new"){
                                    // Newest (Also default)
                                    $query = $mysqli->query("SELECT * FROM code ORDER BY id DESC LIMIT $start, $limit");    
                                // Else order content by default DESC
                                } else {
                                    // Default
                                    $query = $mysqli->query("SELECT * FROM code ORDER BY id DESC LIMIT $start, $limit");
                                }
                                
                                // If search input field isset, retrieve results based on user input
                                if (isset($_GET['search'])){
                                    $query = $mysqli->query("SELECT * FROM code WHERE name LIKE '%".$_GET['search']."%' || language = '".$_GET['search']."'LIMIT $start, $limit");
                                } else {
                                    
                                }
                                
                                // Loop and display every row
                                while ($row = $query->fetch_array()) { ?>
                                    <div class='post'>
                                        <div class='vertical-sm'></div>
                                        <a class='post-title' href='/Project/code/post.php?id=<?php echo $row['id']; ?>'><h4 class='font-header' style='margin-bottom: 0;'><?php echo $row['name']; ?></h4></a>
                                        <span class='language font-grey_lightest font-content'><?php echo $row['language']; ?></span>
                                        <a class='post-user' href='/Project/account/profile.php?id=<?php echo $row['codeid']; ?>'><span class='font-subheader' style='margin-left: 20px;'>/u/<?php echo $row['author']; ?></span></a>
                                        <div class='vertical-sm'></div>
                                    </div>
                                    <div class='vertical-sm'></div>
                                <?php }
                            ?>
                            <div class="content-blackbox">
                                <?php include 'includes/_pagination.php'; ?>
                            </div>
                        </div>
                        <?php include 'includes/_search.php'; ?>
                    </div>
                    <div class="vertical-lg"></div>
                </div>
                
                <div class="account-nav col-1">
                    <?php include 'includes/account-nav.php'; ?>
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
        <!-- Prism syntax highlighter JS -->
        <script src="../../node_modules/prismjs/prism.js"></script>
        <script src="../../node_modules/prismjs/components/prism-php.js"></script>
        <script src="../../node_modules/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.js"></script>
    </body>
</html>