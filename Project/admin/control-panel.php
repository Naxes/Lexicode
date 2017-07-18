<?php
    require '../includes/db.php';
    session_start();
    
    /* Search */
    // Search field input
    $search = $mysqli->escape_string($_POST['search']);
    
    // If request method is post
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        // If search field is blank, redirect
        if ($_POST['search'] === ""){
            if(isset($_GET['list'])){
                header('location: control-panel.php?list='.$_GET['list'].'');
                exit;   
            } else {
                header('location: control-panel.php');
                exit;
            }
        // Else search for content based on user input and redirect
        } else {
            $_GET['search'] = $search;
            // Redirect
            if(isset($_GET['list'])){
                header('location: control-panel.php?list='.$_GET['list'].'&search='.$_GET['search'].'&page=1');
                exit;
            } else {
                header('location: control-panel.php?search='.$_GET['search'].'&page=1');
                exit;
            }
        }
    }
    
    $active_page = "admin";
    $active_tab = $GET['list'];
    
    /* Pagination */
    // Amount of items per page
    $limit = 10;
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
        <title>Control Panel</title>
        
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
        <?php if ($_SESSION['admin'] === "1"){ ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="content-nav col-1">
                            <?php include '../includes/content-nav.php'; ?>
                        </div>
        
                        <div class="col-10 offset-1">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <div class="vertical-md"></div>
                                    <h1 class="font-white text-center"><i class="fa fa-pencil"></i></h1>
                                    <h2 class="font-white font-content text-center">
                                        <?php switch($_GET['list']) {
                                        case "users":
                                            echo "Users";    
                                            break;
                                        case "submissions":
                                            echo "Submissions";
                                            break;
                                        default:
                                            echo "Users";    
                                        } ?>
                                    </h2>
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-3">
                                            <div class="upload-link">
                                                <a href="/Project/admin/control-panel.php?list=users">
                                                    <div class="content-blackbox text-center">
                                                        <span class="font-white font-subheader">Users</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="upload-link">
                                                <a href="/Project/admin/control-panel.php?list=submissions">
                                                    <div class="content-blackbox text-center">
                                                        <span class="font-white font-subheader">Submissions</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-3"></div>
                                    </div>
                                    <div class="vertical-sm"></div>
                                    <div class="content-blackbox" style="padding: 0 10px 0 10px">
                                        <div class="row">
                                            <div class="col-6">
                                                <?php
                                                    switch($_GET['list']){
                                                        case "users": ?>
                                                            <div class="row text-center" style="height: 100%;">
                                                                <div class="col-4" style="padding: 0;">
                                                                    <a href="/Project/admin/control-panel.php?list=users&sort=asc">
                                                                        <div class="a_sort <?php if($_GET['sort'] === "asc") { echo "a_sort-active"; }?>">
                                                                            <i class="font-white fa fa-sort-alpha-asc"></i>    
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-4" style="padding: 0;">
                                                                    <a href="/Project/admin/control-panel.php?list=users&sort=desc">
                                                                        <div class="a_sort <?php if($_GET['sort'] === "desc") { echo "a_sort-active"; }?>">
                                                                            <i class="font-white fa fa-sort-alpha-desc"></i>    
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-4" style="padding: 0;">
                                                                    <a href="/Project/admin/control-panel.php?list=users&sort=spons">
                                                                        <div class="a_sort <?php if($_GET['sort'] === "spons") { echo "a_sort-active"; }?>">
                                                                            <i class="font-white fa fa-handshake-o"></i>    
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <?php break;
                                                        case "submissions": ?>
                                                            <div class="row text-center" style="height: 100%;">
                                                                <div class="col-3" style="padding: 0;">
                                                                    <a href="/Project/admin/control-panel.php?list=submissions&sort=asc">
                                                                        <div class="a_sort <?php if($_GET['sort'] === "asc") { echo "a_sort-active"; }?>">
                                                                            <i class="font-white fa fa-sort-alpha-asc"></i>    
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-3" style="padding: 0;">
                                                                    <a href="/Project/admin/control-panel.php?list=submissions&sort=desc">
                                                                        <div class="a_sort <?php if($_GET['sort'] === "desc") { echo "a_sort-active"; }?>">
                                                                            <i class="font-white fa fa-sort-alpha-desc"></i>    
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-3" style="padding: 0;">
                                                                    <a href="/Project/admin/control-panel.php?list=submissions&sort=pos">
                                                                        <div class="a_sort <?php if($_GET['sort'] === "pos") { echo "a_sort-active"; }?>">
                                                                            <i class="font-white fa fa-trophy"></i>    
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-3" style="padding: 0;">
                                                                    <a href="/Project/admin/control-panel.php?list=submissions&sort=neg">
                                                                        <div class="a_sort <?php if($_GET['sort'] === "neg") { echo "a_sort-active"; }?>">
                                                                            <i class="font-white fa fa-thumbs-down"></i>    
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div> 
                                                            <?php break;
                                                        default: ?>
                                                            <div class="row text-center" style="height: 100%;">
                                                                <div class="col-4" style="padding: 0;">
                                                                    <a href="/Project/admin/control-panel.php?sort=asc">
                                                                        <div class="a_sort <?php if($_GET['sort'] === "asc") { echo "a_sort-active"; }?>">
                                                                            <i class="font-white fa fa-sort-alpha-asc"></i>    
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-4" style="padding: 0;">
                                                                    <a href="/Project/admin/control-panel.php?sort=desc">
                                                                        <div class="a_sort <?php if($_GET['sort'] === "desc") { echo "a_sort-active"; }?>">
                                                                            <i class="font-white fa fa-sort-alpha-desc"></i>    
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-4" style="padding: 0;">
                                                                    <a href="/Project/admin/control-panel.php?sort=spons">
                                                                        <div class="a_sort <?php if($_GET['sort'] === "spons") { echo "a_sort-active"; }?>">
                                                                            <i class="font-white fa fa-handshake-o"></i>    
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>  
                                                    <?php }
                                                ?>
                                            </div>
                                            <div class="col-6" style="border-left: 1px dotted white;">
                                                <form method="post" class="search" autocomplete="off" style="padding-top: 7px;">
                                                    <input type="text" class="form-control" name="search" placeholder="Search" />
                                                    <i class="search-icon  font-white fa fa-search" style="top: 15px;"></i>
                                                </form>    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vertical-sm"></div>
                                    <!-- Top Pagination -->
                                    <div class="content-blackbox">
                                        <?php
                                            // Pagination
                                            switch($_GET['list']){
                                                case "users":
                                                    if(isset($_GET['search'])){
                                                        $count = $mysqli->query("SELECT COUNT(*) FROM users WHERE username LIKE '%".$_GET['search']."%' || email LIKE '%".$_GET['search']."%'");   
                                                    } else {
                                                        $count = $mysqli->query("SELECT COUNT(*) FROM users");
                                                    }
                                                    break;
                                                case "submissions":
                                                    if(isset($_GET['search'])){
                                                        $count = $mysqli->query("SELECT COUNT(*) FROM code WHERE name LIKE '%".$_GET['search']."%' || author = '".$_GET['search']."' || language = '".$_GET['search']."' LIMIT $start, $limit");   
                                                    } else {
                                                        $count = $mysqli->query("SELECT COUNT(*) FROM code");
                                                    }
                                                    break;
                                                default:
                                                    $count = $mysqli->query("SELECT COUNT(*) FROM users");
                                            }
                                            
                                            $row = $count->fetch_array();
                                            $total_records = $row[0];  
                                            $total_pages = ceil($total_records / $limit);
                                            if (isset($_GET['list'])){
                                                $pagLink = "<div class='pagination'>";
                                                for ($i=1; $i<=$total_pages; $i++) {
                                                    if(isset($_GET['search'])){
                                                        if(isset($_GET['sort'])){
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&sort=".$_GET['sort']."&search=".$_GET['search']."&page=".$i."'>".$i."</a></li>";      
                                                        } else {
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&search=".$_GET['search']."&page=".$i."'>".$i."</a></li>";        
                                                        }
                                                    } else {
                                                        if(isset($_GET['sort'])){
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&sort=".$_GET['sort']."&page=".$i."'>".$i."</a></li>";      
                                                        } else {
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&page=".$i."'>".$i."</a></li>";        
                                                        }
                                                    }
                                                };  
                                                echo $pagLink . "</div>";     
                                            } else {
                                                $pagLink = "<div class='pagination'>";  
                                                for ($i=1; $i<=$total_pages; $i++) {
                                                    if(isset($_GET['search'])){
                                                        if(isset($_GET['sort'])){
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&sort=".$_GET['sort']."&search=".$_GET['search']."&page=".$i."'>".$i."</a></li>";      
                                                        } else {
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&search=".$_GET['search']."&page=".$i."'>".$i."</a></li>";        
                                                        }
                                                    } else {
                                                        if(isset($_GET['sort'])){
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&sort=".$_GET['sort']."&page=".$i."'>".$i."</a></li>";      
                                                        } else {
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&page=".$i."'>".$i."</a></li>";        
                                                        }
                                                    }
                                                };  
                                                echo $pagLink . "</div>";     
                                            }
                                        ?>
                                    </div>
                                    <div class="vertical-sm"></div>
                                    <table class="table table-inverse">
                                        <thead>
                                            <?php
                                                switch($_GET['list']){
                                                    case "users": ?>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Username</th>
                                                            <th>Email</th>
                                                            <th>P_Rights</th>
                                                            <th>A_Rights</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>    
                                                        <?php break;
                                                    case "submissions": ?>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Language</th>
                                                            <th>Author</th>
                                                            <th>Votes</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        <?php break;
                                                    default: ?>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Username</th>
                                                            <th>Email</th>
                                                            <th>P_Rights</th>
                                                            <th>A_Rights</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    <?php
                                                    
                                                }
                                            ?>
                                        </thead>
                                        <?php
                                            switch($_GET['list']){
                                                case "users":
                                                    // Sort by asc/desc/spons
                                                    switch($_GET['sort']){
                                                        case "asc":
                                                            $query = $mysqli->query("SELECT * FROM users ORDER BY username ASC LIMIT $start, $limit"); 
                                                            break;
                                                        case "desc":
                                                            $query = $mysqli->query("SELECT * FROM users ORDER BY username DESC LIMIT $start, $limit");
                                                            break;
                                                        case "spons":
                                                            $query = $mysqli->query("SELECT * FROM users WHERE partner_rights = 1");
                                                            break;
                                                        default:
                                                            $query = $mysqli->query("SELECT * FROM users LIMIT $start, $limit");
                                                    }
                                                    
                                                    if(isset($_GET['search'])){
                                                        $query = $mysqli->query("SELECT * FROM users WHERE username LIKE '%".$_GET['search']."%' || email LIKE '%".$_GET['search']."%' LIMIT $start, $limit");
                                                    }
                                            
                                                    while ($row = $query->fetch_array()){ ?>
                                                        <tr>
                                                            <th><?php echo $row['id']; ?></th>
                                                            <th><?php echo $row['username']; ?></th>
                                                            <th><?php echo $row['email']; ?></th>
                                                            <th><?php echo $row['partner_rights']; ?></th>
                                                            <th><?php echo $row['admin_rights']; ?></th>
                                                            <th><a href="/Project/admin/edit/user.php?id=<?php echo $row['id']; ?>"><i class="edit-details fa fa-pencil-square"></i></a></th>
                                                            <th><a href="/Project/admin/edit/delete.php?type=user&id=<?php echo $row['id']; ?>"><i class="delete-submission fa fa-times-circle"></i></a></th>
                                                        </tr>   
                                                    <?php }    
                                                    break;
                                                case "submissions":
                                                    // Sort by asc/desc/top/neg
                                                    switch($_GET['sort']){
                                                        case "asc":
                                                            $query = $mysqli->query("SELECT * FROM code ORDER BY name ASC LIMIT $start, $limit"); 
                                                            break;
                                                        case "desc":
                                                            $query = $mysqli->query("SELECT * FROM code ORDER BY name DESC LIMIT $start, $limit");
                                                            break;
                                                        case "pos":
                                                            $query = $mysqli->query("SELECT * FROM code ORDER BY votes DESC LIMIT $start, $limit");
                                                            break;
                                                        case "neg":
                                                            $query = $mysqli->query("SELECT * FROM code ORDER BY votes ASC LIMIT $start, $limit");
                                                            break;
                                                        default:
                                                            $query = $mysqli->query("SELECT * FROM code LIMIT $start, $limit");
                                                    }
                                                    
                                                    if(isset($_GET['search'])){
                                                        $query = $mysqli->query("SELECT * FROM code WHERE name LIKE '%".$_GET['search']."%' || author = '".$_GET['search']."' || language = '".$_GET['search']."' LIMIT $start, $limit");   
                                                    }
                                            
                                                    while ($row = $query->fetch_array()){ ?>
                                                        <tr>
                                                            <th><?php echo $row['id']; ?></th>
                                                            <th><?php echo $row['name']; ?></th>
                                                            <th><?php echo $row['language']; ?></th>
                                                            <th><?php echo $row['author']; ?></th>
                                                            <th><?php echo $row['votes']; ?></th>
                                                            <th><a href="/Project/admin/edit/submission.php?id=<?php echo $row['id']; ?>"><i class="edit-details fa fa-pencil-square"></i></a></th>
                                                            <th><a href="/Project/admin/edit/delete.php?type=submission&id=<?php echo $row['id']; ?>"><i class="delete-submission fa fa-times-circle"></i></a></th>
                                                        </tr>   
                                                    <?php }
                                                    break;
                                                default:
                                                    // Sort by asc/desc/spons
                                                    switch($_GET['sort']){
                                                        case "asc":
                                                            $query = $mysqli->query("SELECT * FROM users ORDER BY username ASC LIMIT $start, $limit"); 
                                                            break;
                                                        case "desc":
                                                            $query = $mysqli->query("SELECT * FROM users ORDER BY username DESC LIMIT $start, $limit");
                                                            break;
                                                        case "spons":
                                                            $query = $mysqli->query("SELECT * FROM users WHERE partner_rights = 1");
                                                            break;
                                                        default:
                                                            $query = $mysqli->query("SELECT * FROM users LIMIT $start, $limit");
                                                    }
                                                    
                                                    if(isset($_GET['search'])){
                                                            $query = $mysqli->query("SELECT * FROM users WHERE username LIKE '%".$_GET['search']."%' || email LIKE '%".$_GET['search']."%' LIMIT $start, $limit");   
                                                    } else {
                                                      
                                                    }
                                                
                                                    while ($row = $query->fetch_array()){ ?>
                                                        <tr>
                                                            <th><?php echo $row['id']; ?></th>
                                                            <th><?php echo $row['username']; ?></th>
                                                            <th><?php echo $row['email']; ?></th>
                                                            <th><?php echo $row['partner_rights']; ?></th>
                                                            <th><?php echo $row['admin_rights']; ?></th>
                                                            <th><a href="/Project/admin/edit/user.php?id=<?php echo $row['id']; ?>"><i class="edit-details fa fa-pencil-square"></i></a></th>
                                                            <th><a href="/Project/admin/edit/delete.php?type=user&id=<?php echo $row['id']; ?>"><i class="delete-submission fa fa-times-circle"></i></a></th>
                                                        </tr>   
                                                <?php }    
                                            }
                                        ?>
                                    </table>
                                    <div class="vertical-sm"></div>
                                    <!-- Bottom Pagination -->
                                    <div class="content-blackbox">
                                        <?php
                                            // Pagination
                                            switch($_GET['list']){
                                                case "users":
                                                    if(isset($_GET['search'])){
                                                        $count = $mysqli->query("SELECT COUNT(*) FROM users WHERE username LIKE '%".$_GET['search']."%' || email LIKE '%".$_GET['search']."%'");   
                                                    } else {
                                                        $count = $mysqli->query("SELECT COUNT(*) FROM users");
                                                    }
                                                    break;
                                                case "submissions":
                                                    if(isset($_GET['search'])){
                                                        $count = $mysqli->query("SELECT COUNT(*) FROM code WHERE name LIKE '%".$_GET['search']."%' || author = '".$_GET['search']."' || language = '".$_GET['search']."' LIMIT $start, $limit");   
                                                    } else {
                                                        $count = $mysqli->query("SELECT COUNT(*) FROM code");
                                                    }
                                                    break;
                                                default:
                                                    $count = $mysqli->query("SELECT COUNT(*) FROM users");
                                            }
                                            
                                            $row = $count->fetch_array();
                                            $total_records = $row[0];  
                                            $total_pages = ceil($total_records / $limit);
                                            if (isset($_GET['list'])){
                                                $pagLink = "<div class='pagination'>";  
                                                for ($i=1; $i<=$total_pages; $i++) {
                                                    if(isset($_GET['search'])){
                                                        if(isset($_GET['sort'])){
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&sort=".$_GET['sort']."&search=".$_GET['search']."&page=".$i."'>".$i."</a></li>";      
                                                        } else {
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&search=".$_GET['search']."&page=".$i."'>".$i."</a></li>";        
                                                        }
                                                    } else {
                                                        if(isset($_GET['sort'])){
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&sort=".$_GET['sort']."&page=".$i."'>".$i."</a></li>";      
                                                        } else {
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&page=".$i."'>".$i."</a></li>";        
                                                        }
                                                    }
                                                };  
                                                echo $pagLink . "</div>";     
                                            } else {
                                                $pagLink = "<div class='pagination'>";  
                                                for ($i=1; $i<=$total_pages; $i++) {
                                                    if(isset($_GET['search'])){
                                                        if(isset($_GET['sort'])){
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&sort=".$_GET['sort']."&search=".$_GET['search']."&page=".$i."'>".$i."</a></li>";      
                                                        } else {
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&search=".$_GET['search']."&page=".$i."'>".$i."</a></li>";        
                                                        }
                                                    } else {
                                                        if(isset($_GET['sort'])){
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&sort=".$_GET['sort']."&page=".$i."'>".$i."</a></li>";      
                                                        } else {
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='control-panel.php?list=".$_GET['list']."&page=".$i."'>".$i."</a></li>";        
                                                        }
                                                    }
                                                };  
                                                echo $pagLink . "</div>";     
                                            }
                                        ?>
                                    </div>
                                    <div class="vertical-sm"></div>
                                </div>
                                <div class="col-2"></div>
                            </div>
                        </div>
                        
                        <div class="account-nav col-1">
                            <?php include '../includes/account-nav.php'; ?>
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
            <?php } else {
                header('location: ../index.php');
                exit;
            }
        ?>
    </body>
</html>