<?php
    require '../../includes/db.php';
    session_start();
    
    $query = $mysqli->query("SELECT * FROM code WHERE id = '".$_GET['id']."'");
    $row = $query->fetch_array();
    if ($_SESSION['loggedin'] === true && $row['codeid'] === $_SESSION['userid']){
        // Delete query
        $delete = $mysqli->query("DELETE FROM code WHERE id = '".$_GET['id']."' && codeid = '".$_SESSION['userid']."'");
        $alter = $mysqli->query("ALTER TABLE code AUTO_INCREMENT = 1");
        // Success message
        $_SESSION['message-type'] = "success-message";
        $_SESSION['message'] = "Submission deleted";
        
        // Redirect to profile
        header('location: ../profile.php?id='.$_SESSION['userid'].'');
        exit;   
    } else if ($_SESSION['loggedin'] === true && $row['codeid'] != $_SESSION['userid']){
        header('location: ../profile.php?id='.$_SESSION['userid'].'');
        exit;
    } else {
        header('location: ../../index.php');
        exit; 
    }
?>