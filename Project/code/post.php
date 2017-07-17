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
                                    <?php
                                        // If search input field isset, retrieve results based on user input
                                        if (isset($_GET['search'])){
                                            $query = $mysqli->query("SELECT * FROM code WHERE name LIKE '%".$_GET['search']."%' || language = '".$_GET['search']."'LIMIT $start, $limit");
                                        } else {
                                            
                                        }
                                    
                                        $query = $mysqli->query("SELECT * FROM code WHERE id = '".$_GET['id']."'");
                                        
                                        while ($row = $query->fetch_array()) { ?>
                                            <div class='post content-blackbox'>
                                                <div class='vertical-sm'></div>
                                                <div class="row">
                                                    <div class="col-1 text-center">
                                                        <?php 
                                                            $vote = $mysqli->query("SELECT * FROM code_votes WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$row['id']."'");
                                                            $vote_row = $vote->fetch_array();
                                                            
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <a href="/Project/code/vote.php?sort=<?php echo $_GET['sort']?>&page=<?php echo $_GET['page']?>&type=upvote&id=<?php echo $row['id']; ?>" class="<?php if($_SESSION['loggedin'] === true) { echo "ajaxLink"; }?>"><i class="<?php if($row['id'] === $vote_row['fk_postid'] && $vote_row['vote'] === "upvote") { echo "upvote"; } else { echo "font-white"; }?> fa fa-chevron-up"></i></a>
                                                            </div>
                                                            <div class="col-12">
                                                                <span class='font-grey_lightest font-content'><?php echo $row['votes']; ?></span> 
                                                            </div>
                                                            <div class="col-12">
                                                                <a href="/Project/code/vote.php?sort=<?php echo $_GET['sort']?>&page=<?php echo $_GET['page']?>&type=downvote&id=<?php echo $row['id']; ?>" class="<?php if($_SESSION['loggedin'] === true) { echo "ajaxLink"; }?>"><i class="<?php if($row['id'] === $vote_row['fk_postid'] && $vote_row['vote'] === "downvote") { echo "downvote"; } else { echo "font-white"; }?> fa fa-chevron-down"></i></a>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-11">
                                                        <a class='post-title' href='/Project/code/post.php?id=<?php echo $row['id']; ?>'><h4 class='font-header'><?php echo $row['name']; ?></h4></a>
                                                        <span class='language font-grey_lightest font-content'><?php echo $row['language']; ?></span>
                                                        <a class='post-user' href='/Project/account/profile.php?id=<?php echo $row['codeid']; ?>'><span class='font-subheader'>/u/<?php echo $row['author']; ?></span></a> 
                                                        <div class='vertical-sm'></div>
                                                        <h7 class='font-white font-subheader'>Description</h7>
                                                        <div class='post-content'>
                                                            <p class='font-white font-content'><?php echo $row['description']; ?></p>
                                                        </div>
                                                        <div class='vertical-sm'></div>
                                                        <h7 class='font-white font-subheader'>Code</h7>
                                                        <div class='post-content'>
                                                            <pre><code class='language-<?php echo $row['language']; ?>'><?php echo htmlspecialchars($row['code']); ?>
                                                            </code></pre>
                                                        </div>
                                                        <!-- Link to sponsored courses -->
                                                        <?php
                                                            if ($row['sponsored'] === "1"){ ?>
                                                                <div class='vertical-sm'></div>
                                                                <h7 class='font-white font-subheader'><?php echo $row['author']; ?>'s <?php echo $row['language']; ?> course</h7>
                                                                <div class="post-content">
                                                                    <p><a href="<?php echo $row['affiliate_link']; ?>" target="_blank"><?php echo $row['author']; ?> | <?php echo $row['language']; ?></a></p>
                                                                </div>    
                                                            <?php }
                                                        ?>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            <div class='vertical-sm'></div>
                                        <?php }
                                    ?>
                                </div>
                                <?php include '../includes/_search.php'; ?>
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
        <!-- PrismJS main -->
        <script src="../../../node_modules/prismjs/prism.js"></script>
        <!-- Sass support (PrismJS) -->
        <script src="../../../node_modules/prismjs/components/prism-scss.js"></script>
        <!-- PHP support (PrismJS) -->
        <script src="../../../node_modules/prismjs/components/prism-php.js"></script>
        <!-- SQL support (PrismJS) -->
        <script src="../../../node_modules/prismjs/components/prism-sql.js"></script>
        <!-- Git support (PrismJS) -->
        <script src="../../../node_modules/prismjs/components/prism-git.js"></script>
        <!-- Normalize whitespace (PrismJS) -->
        <script src="../../../node_modules/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.js"></script>
        <!-- jQuery min -->
        <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
        <script>
            $('.ajaxLink').click(function(e){
                e.preventDefault(); // Prevents default link action
                $.ajax({
                    url: $(this).attr('href'),
                    success: function(content){
                        $("body").html(content);
                    }
                });
            });
        </script>
    </body>
</html>