<?php
    require '../includes/db.php';
    session_start();
    
    $query = $mysqli->query("SELECT * FROM tickets WHERE adminid = '".$_SESSION['userid']."'");
    $row = $query->fetch_array();

    if ($_SESSION['loggedin'] === true && $_SESSION['admin'] === "1"){
        $delete = $mysqli->query("DELETE FROM tickets WHERE id = '".$_GET['id']."'");
        $alter = $mysqli->query("ALTER TABLE tickets AUTO_INCREMENT = 1");
        
        // Success message
        $_SESSION['message-type'] = "success-message";
        $_SESSION['message'] = "Ticket complete";
        
        // Redirect to profile
        header('location: ../account/profile.php?id='.$_SESSION['userid'].'');
        exit;     
    } else {
        header('location: ../index.php');
        exit;
    }
?>