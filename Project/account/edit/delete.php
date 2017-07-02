<?php
    require '../../includes/db.php';
    session_start();
    
    $query = $mysqli->query("SELECT * FROM code WHERE codeid = '".$_SESSION['userid']."'");
    $row = $query->fetch_array();
    if ($_SESSION['loggedin'] === true && $row['codeid'] === $_SESSION['userid']){
        // Delete query
        $delete = $mysqli->query("DELETE FROM code WHERE id = '".$_GET['id']."' && codeid = '".$_SESSION['userid']."'");
        
        // Success message
        $_SESSION['message'] = "Submission deleted";
        
        // Redirect to profile
        header('location: ../profile.php?id='.$_SESSION['userid'].'');
        exit;   
    } else {
        header('location: ../../index.php');
        exit;
    }
?>