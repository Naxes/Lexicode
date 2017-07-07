<?php
    require '../includes/db.php';
    session_start();
    
    $active_page = "upload";
    
    // Upload
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['upload'])){
            
            $name = $mysqli->escape_string($_POST['name']);
            $description = $mysqli->escape_string($_POST['description']);
            $code = $mysqli->escape_string($_POST['code']);
            $language = $_POST['language'];
            $author = $_SESSION['username'];
            $codeid = $_SESSION['userid'];
            $sponsored = $_SESSION['sponsored'];
            
            if ($_SESSION['sponsored'] === "1") {
                $affiliate = $_POST['affiliate'];
                
                $sql = "INSERT INTO code (name, description, code, language, author, sponsored, affiliate_link, codeid)
                    VALUES ('$name', '$description', '$code', '$language', '$author', '$sponsored', '$affiliate', '$codeid')";    
            } else {
                $sql = "INSERT INTO code (name, description, code, language, author, sponsored, codeid)
                    VALUES ('$name', '$description', '$code', '$language', '$author', '$sponsored', '$codeid')";
            }
            
            if ($mysqli->query($sql)){
                // Success message
                $_SESSION['message-type'] = "success-message";
                $_SESSION['message'] = "Code submitted";
                header('location: ../index.php');
                exit;
            } else {
                // Error message
                $_SESSION['message-type'] = "error-message";
                $_SESSION['message'] = "Could not upload";
                header('location: ../index.php');
                exit;
            }
        }
    }
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
        <?php if ($_SESSION['loggedin'] === true && $_SESSION['admin'] === "0"){ // Show upload page
            ?>
            <div class="container-fluid">
                    <div class="row">
                        <div class="content-nav col-1">
                            <?php include '../includes/content-nav.php'?>
                        </div>
                        
                        <div class="col-10 offset-1">
                            <!-- Upload form -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <div class="vertical-md"></div>
                                        <h1 class="font-white text-center"><i class="fa fa-upload"></i></h1>
                                        <h2 class="font-white font-content text-center">Upload a snippet</h2>
                                        <div class="vertical-md"></div>
                                        
                                        <div class="content-blackbox">
                                            <form method="post" autocomplete="off">
                                                <!-- Code name -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="name">Name:</label>
                                                            <input type="text" class="form-control" name="name" autocomplete="off" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Code description -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="description">Description:</label>
                                                            <textarea type="text" class="form-control" name="description" autocomplete="off" style="resize: none;" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Code snippet -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="code">Code:</label>
                                                            <textarea type="text" id="code" class="form-control" name="code" autocomplete="off" style="white-space: nowrap;" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <?php
                                                    if ($_SESSION['sponsored'] === "1"){ ?>
                                                        <!-- Affiliate link -->
                                                        <div class="container">
                                                            <div class="form-group row">
                                                                <div class="col-12">
                                                                    <label class="font-white" for="affiliate">Affiliate link:</label>
                                                                    <input type="text" class="form-control" name="affiliate" autocomplete="off" required />
                                                                </div>
                                                            </div>
                                                        </div>   
                                                    <?php }
                                                ?>
                                                
                                                <!-- Language -->
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="language">Language:</label>
                                                            <select class="form-control" name="language" required>
                                                                <option value="">Please select</option>
                                                                <option>HTML</option>
                                                                <option>CSS</option>
                                                                <option>SCSS</option>
                                                                <option>Javascript</option>
                                                                <option>PHP</option>
                                                                <option>SQL</option>
                                                                <option>Git</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="vertical-sm"></div>
                                                
                                                <!-- Upload button -->
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input type="submit" class="btn btn-primary" name="upload" value="Upload"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="vertical-lg"></div>
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="account-nav col-1">
                            <?php include '../includes/account-nav.php'; ?>
                        </div>
                    </div>
                </div>
        <?php }else{ // Redirect to home page
            $_SESSION['message-type'] = "error-message";
            $_SESSION['message'] = "You must be logged in to upload";
            header('location: ../index.php');
            exit;
        }?>
        <script src="/Project/js/main.js"></script>
    </body>
</html>