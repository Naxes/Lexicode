<?php
    require '../../includes/db.php';
    session_start();

    if($_SESSION['admin'] === "1"){
        switch($_GET['type']){
            case "user":
                $mysqli->begin_transaction();
                    $select = $mysqli->query("SELECT * FROM users WHERE id = '".$_GET['id']."'");
                    $row = $select->fetch_array();
                    $mysqli->query("DELETE FROM code WHERE codeid = '".$row['userid']."'");
                    $mysqli->query("DELETE FROM users WHERE id = '".$_GET['id']."'");
                    $mysqli->query("ALTER TABLE users AUTO_INCREMENT = 1");
                $mysqli->commit();
                break;
            case "submission":
                $mysqli->begin_transaction();
                    $mysqli->query("DELETE FROM code WHERE id = '".$_GET['id']."'");
                    $mysqli->query("ALTER TABLE code AUTO_INCREMENT = 1");
                $mysqli->commit();
                break;
        }
        header('location: '. $_SERVER['HTTP_REFERER']);
        exit;
    }
    header('location: ../../index.php');
    exit;
?>