<?php
    require '../../includes/db.php';
    session_start();
    
    $active_page = "submission";
    
    // Edit Submission
    $query = $mysqli->query("SELECT * FROM code WHERE id = '".$_GET['id']."' && codeid = '".$_SESSION['userid']."'");
    $row = $query->fetch_array();
    
    $name = $mysqli->escape_string($_POST['name']);
    $description = $mysqli->escape_string($_POST['description']);
    $code = $mysqli->escape_string($_POST['code']);
    $language = $_POST['language'];
    
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['update'])){
            if ($query->num_rows > 0){
                // Update submission
                $update = $mysqli->query("UPDATE code SET name = '$name', description = '$description', code = '$code', language = '$language' WHERE id = '".$_GET['id']."'");
                
                // Success message
                $_SESSION['message-type'] = "success-message";
                $_SESSION['message'] = "Submission updated";
                
                // Redirect to profile
                header("location: ../profile.php?id=".$_SESSION['userid']."");
                exit;    
            } else {
                // Redirect to profile
                header("location: ../profile.php?id=".$_SESSION['userid']."");
                exit;  
            }
        }
    }
?>

<!DOCTYPE html>
    <head>
        <title>Profile | Edit Submission</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        
        <!-- Style -->
        <link rel="stylesheet" href="../../css/output.css"/>
    </head>
    <body>
        <?php if ($_SESSION['loggedin'] === true && $_GET['id'] != "" && $row['codeid'] === $_SESSION['userid']){
            ?>
            <div class="container-fluid">
                    <div class="row">
                        <div class="content-nav col-1">
                            <?php include '../../includes/content-nav.php'?>
                        </div>
                        
                        <div class="col-10 offset-1">
                            <!-- Login form -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <div class="vertical-md"></div>
                                        <h1 class="font-white text-center"><i class="fa fa-pencil"></i></h1>
                                        <h2 class="font-white font-content text-center">Edit Submission</h2>
                                        <div class="vertical-md"></div>
                                        
                                        <div class="content-blackbox">
                                            <form method="post" autocomplete="off">
                                                <!-- Code name -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="name">Name:</label>
                                                            <input type="text" class="form-control" name="name" autocomplete="off" value="<?php echo $row['name']; ?>" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Code description -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="description">Description:</label>
                                                            <textarea type="text" class="form-control" name="description" autocomplete="off" style="resize: none;" required><?php echo $row['description']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Code snippet -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="code">Code:</label>
                                                            <textarea type="text" id="code" class="form-control" name="code" autocomplete="off" style="white-space: nowrap;" required><?php echo $row['code']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Language -->
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="language">Language:</label>
                                                            <select class="form-control" name="language" required>
                                                                <option value="">Please select</option>
                                                                <option <?php if ($row['language'] === "HTML") { echo "selected='selected'"; } ?>>HTML</option>
                                                                <option <?php if ($row['language'] === "CSS") { echo "selected='selected'"; } ?>>CSS</option>
                                                                <option <?php if ($row['language'] === "Javascript") { echo "selected='selected'"; } ?>>Javascript</option>
                                                                <option <?php if ($row['language'] === "PHP") { echo "selected='selected'"; } ?>>PHP</option>
                                                                <option <?php if ($row['language'] === "Git") { echo "selected='selected'"; } ?>>Git</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="vertical-sm"></div>
                                                
                                                <!-- Upload button -->
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input type="submit" class="btn btn-primary" name="update" value="Update"></input>
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
                            <?php include '../../includes/account-nav.php'; ?>
                        </div>
                    </div>
                </div>
        <?php }else{ // Redirect to home page
            header("location: ../profile.php?id=".$_SESSION['userid']."");
        }?>
        <script src="/Project/js/main.js"></script>
    </body>
</html>