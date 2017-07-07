<?php
    // Pagination
    if (isset($_GET['search'])){
        $count = $mysqli->query("SELECT COUNT(*) FROM code WHERE name LIKE '%".$_GET['search']."%' || language = '".$_GET['search']."'");
        $row = $count->fetch_array();
        $total_records = $row[0];  
        $total_pages = ceil($total_records / $limit);
        if (isset($_GET['sort'])){
            $pagLink = "<div class='pagination'>";  
            for ($i=1; $i<=$total_pages; $i++) {  
                         $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?search=".$_GET['search']."&sort=".$_GET['sort']."&page=".$i."'>".$i."</a></li>";  
            };  
            echo $pagLink . "</div>";     
        } else {
            $pagLink = "<div class='pagination'>";  
            for ($i=1; $i<=$total_pages; $i++) {  
                         $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?search=".$_GET['search']."&page=".$i."'>".$i."</a></li>";  
            };  
            echo $pagLink . "</div>";     
        }
    } else {
        $count = $mysqli->query("SELECT COUNT(*) FROM code");
        $row = $count->fetch_array();
        $total_records = $row[0];  
        $total_pages = ceil($total_records / $limit);
        if (isset($_GET['sort'])){
            $pagLink = "<div class='pagination'>";  
            for ($i=1; $i<=$total_pages; $i++) {  
                         $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?sort=".$_GET['sort']."&page=".$i."'>".$i."</a></li>";  
            };  
            echo $pagLink . "</div>";     
        } else {
            $pagLink = "<div class='pagination'>";  
            for ($i=1; $i<=$total_pages; $i++) {  
                         $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=".$i."'>".$i."</a></li>";  
            };  
            echo $pagLink . "</div>";     
        }
    }
?>