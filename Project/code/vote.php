<?php
    require '../includes/db.php';
    session_start();
    
    // If user is logged in, allow vote
    if($_SESSION['loggedin'] === true){
        switch($_GET['type']){
            // Type is upvote
            case "upvote":
                $query = $mysqli->query("SELECT * FROM code_votes WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."'");
                if($query->num_rows <= 0){
                    $mysqli->begin_transaction();
                        $mysqli->query("UPDATE code SET votes = votes + 1 WHERE id = '".$_GET['id']."'");
                        $mysqli->query("INSERT INTO code_votes (fk_userid, fk_postid, vote)
                        VALUES ('".$_SESSION['userid']."', '".$_GET['id']."', '".$_GET['type']."')");
                    $mysqli->commit();
                } else {
                    $query = $mysqli->query("SELECT * FROM code_votes WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."' && vote = '".$_GET['type']."'"); 
                    if($query->num_rows > 0){
                        $mysqli->begin_transaction();
                            $mysqli->query("UPDATE code SET votes = votes - 1 WHERE id = '".$_GET['id']."'");
                            $mysqli->query("UPDATE code_votes SET fk_userid = '".$_SESSION['userid']."', fk_postid = '".$_GET['id']."', vote = 'default' WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."'");
                        $mysqli->commit();
                    } else {
                        $query = $mysqli->query("SELECT * FROM code_votes WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."' && vote = 'downvote'");
                        if($query->num_rows > 0){
                            $mysqli->begin_transaction();
                                $mysqli->query("UPDATE code SET votes = votes + 2 WHERE id = '".$_GET['id']."'");
                                $mysqli->query("UPDATE code_votes SET fk_userid = '".$_SESSION['userid']."', fk_postid = '".$_GET['id']."', vote = 'upvote' WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."'");
                            $mysqli->commit();   
                        } else {
                            $mysqli->begin_transaction();
                                $mysqli->query("UPDATE code SET votes = votes + 1 WHERE id = '".$_GET['id']."'");
                                $mysqli->query("UPDATE code_votes SET fk_userid = '".$_SESSION['userid']."', fk_postid = '".$_GET['id']."', vote = 'upvote' WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."'");
                            $mysqli->commit();
                        }
                    }
                }
                $mysqli->close();
                header("location: " . $_SERVER['HTTP_REFERER']);
                exit;
                break;
            // Type is downvote
            case "downvote":
                $query = $mysqli->query("SELECT * FROM code_votes WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."'");
                if($query->num_rows <= 0){
                    $mysqli->begin_transaction();
                        $mysqli->query("UPDATE code SET votes = votes - 1 WHERE id = '".$_GET['id']."'");
                        $mysqli->query("INSERT INTO code_votes (fk_userid, fk_postid, vote)
                        VALUES ('".$_SESSION['userid']."', '".$_GET['id']."', '".$_GET['type']."')");
                    $mysqli->commit();
                } else {
                    $query = $mysqli->query("SELECT * FROM code_votes WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."' && vote = '".$_GET['type']."'"); 
                    if($query->num_rows > 0){
                        $mysqli->begin_transaction();
                            $mysqli->query("UPDATE code SET votes = votes + 1 WHERE id = '".$_GET['id']."'");
                            $mysqli->query("UPDATE code_votes SET fk_userid = '".$_SESSION['userid']."', fk_postid = '".$_GET['id']."', vote = 'default' WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."'");
                        $mysqli->commit();
                    } else {
                        $query = $mysqli->query("SELECT * FROM code_votes WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."' && vote = 'upvote'");
                        if($query->num_rows > 0){
                            $mysqli->begin_transaction();
                                $mysqli->query("UPDATE code SET votes = votes - 2 WHERE id = '".$_GET['id']."'");
                                $mysqli->query("UPDATE code_votes SET fk_userid = '".$_SESSION['userid']."', fk_postid = '".$_GET['id']."', vote = 'downvote' WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."'");
                            $mysqli->commit();   
                        } else {
                            $mysqli->begin_transaction();
                                $mysqli->query("UPDATE code SET votes = votes - 1 WHERE id = '".$_GET['id']."'");
                                $mysqli->query("UPDATE code_votes SET fk_userid = '".$_SESSION['userid']."', fk_postid = '".$_GET['id']."', vote = 'downvote' WHERE fk_userid = '".$_SESSION['userid']."' && fk_postid = '".$_GET['id']."'");
                            $mysqli->commit();
                        }
                    }
                }
                $mysqli->close();
                header("location: " . $_SERVER['HTTP_REFERER']);
                exit;
                break;
            // Type is blank
            default;
                header('location: ../index.php');
                exit;
                break;
        }
    } else {
        header('location: ../account/login.php');
        exit;
    }
?>