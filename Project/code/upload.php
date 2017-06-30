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
            $author = $_SESSION['username'];
            $codeid = $_SESSION['userid'];
            
            $sql = "INSERT INTO code (name, description, code, author, codeid)
                    VALUES ('$name', '$description', '$code', '$author', '$codeid')";
            
            if ($mysqli->query($sql)){
                // Upload the code
                $_SESSION['message'] = "Code submitted";
                header('location: ../index.php');
                exit;
            } else {
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
        <?php if ($_SESSION['loggedin'] === true){ // Show upload page
            ?>
            <div class="container-fluid">
                    <div class="row">
                        <div class="content-nav col-1">
                            <?php include '../includes/content-nav.php'?>
                        </div>
                        
                        <div class="col-10 offset-1">
                            <!-- Login form -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <div class="vertical-md"></div>
                                        <h1 class="font-white text-center"><i class="fa fa-upload"></i></h1>
                                        <h2 class="font-white font-content text-center">Upload a snippet</h2>
                                        <p class="font-white font-content text-center">(Please do not use this yet, it's a WIP)</p>
                                        <div class="vertical-md"></div>
                                        
                                        <div class="content-blackbox">
                                            <form method="post" autocomplete="off">
                                                <!-- Code name -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white">Name:</label>
                                                            <input type="text" class="form-control" name="name" autocomplete="off" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Code description -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="password1">Description:</label>
                                                            <textarea type="text" class="form-control" name="description" autocomplete="off" style="resize: none;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Code snippet -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="password1">Code:</label>
                                                            <textarea type="text" id="code" class="form-control" name="code" autocomplete="off"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Code snippet -->
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input type="submit" class="btn btn-primary" name="upload" value="Upload"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
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
            header('location: ../index.php');
        }?>
        <script src="/Project/js/main.js"></script>
    </body>
</html>