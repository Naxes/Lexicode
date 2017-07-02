<?php
    require '../includes/db.php';
    session_start();
    
    $active_page = "post"
?>

<!DOCTYPE html>
    <head>
        <title>Post</title>
        
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
        <?php if ($_GET['id'] != ""){ ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="content-nav col-1">
                            <?php include '../includes/content-nav.php'; ?>
                        </div>
        
                        <div class="col-10 offset-1">
                            <div class="vertical-lg"></div>
                            <div class="row">
                                <div class="col-8">
                                    <?php 
                                        $query = $mysqli->query("SELECT * FROM code WHERE id = '".$_GET['id']."'");
                                        
                                        while ($row = $query->fetch_array()) {
                                            echo "<div class='post content-blackbox'>
                                                <a class='post-title' href='/Project/code/post.php?id=".$row['id']."'><h4 class='font-header' style='margin-bottom: 0;'>".$row['name']."</h4></a>
                                                <a class='post-user' href='/Project/account/profile.php?id=".$row['codeid']."'><span class='font-subheader' style='margin-left: 20px;'>/u/".$row['author']."</span></a>
                                                <div class='vertical-sm'></div>
                                                <h7 class='font-white font-subheader' style='margin-left: 20px;'>Description</h7>
                                                <div class='post-content'>
                                                    <p class='font-white font-content'>".$row['description']."</p>
                                                </div>
                                                <div class='vertical-sm'></div>
                                                <h7 class='font-white font-subheader' style='margin-left: 20px;'>Code</h7>
                                                <div class='post-content'>
                                                    <pre><code class='language-".$row['language']."'>".htmlspecialchars($row['code'])."
                                                    </code></pre>
                                                </div>
                                            </div>
                                            <div class='vertical-sm'></div>";
                                        }
                                    ?>
                                </div>
                                <?php include '../includes/search.php'; ?>
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
        <script src="../../../node_modules/prismjs/prism.js"></script>
        <script src="../../../node_modules/prismjs/components/prism-php.js"></script>
        <script src="../../../node_modules/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.js"></script>
    </body>
</html>