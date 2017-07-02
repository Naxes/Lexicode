<div class="col-4">
    <div class="content-blackbox">
        <form method="post" class="search" autocomplete="off">
            <input type="text" class="form-control" placeholder="Search"/>
            <i class="search-icon font-white fa fa-search"></i>
        </form>
    </div>
    <div class="vertical-sm"></div>
    <div class="upload-link">
        <a href="/Project/code/upload.php">
            <div class="content-blackbox text-center">
                <span class="font-white font-subheader">Submit new code</span>
            </div>
        </a>
    </div>
    <div class="vertical-sm"></div>
    <h6 class="font-white font-content">NEW USERS</h6>
    <div class="user-list">
        <div class="content-blackbox">
            <?php 
                $query = $mysqli->query("SELECT * FROM users WHERE (admin_rights = 0) ORDER BY id DESC LIMIT 10");
                
                while ($row = $query->fetch_array()){
                    echo "<a href='/Project/account/profile.php?id=".$row['userid']."'>";
                
                    echo    "<div class='vertical-sm'></div>
                            <div class='row'>
                                <div class='col-12'>";
                                    if ($row['image'] === ""){
                                        echo "<img src='/Project/images/default.png' alt='Default profile picture'/>";
                                        if ($row['userid'] === $_SESSION['userid']){
                                            echo "<span class='font-white font-content' style='padding-left: 20px;'>".$row['username']." (You)</span>";
                                        } else {
                                            echo "<span class='font-white font-content' style='padding-left: 20px;'>".$row['username']."</span>"; 
                                        }
                                    } else {
                                        echo "<img src='/Project/images/".$row['image']."' alt='Profile picture'/>";
                                        if ($row['userid'] === $_SESSION['userid']){
                                            echo "<span class='font-white font-content' style='padding-left: 20px;'>".$row['username']." (You)</span>";
                                        } else {
                                            echo "<span class='font-white font-content' style='padding-left: 20px;'>".$row['username']."</span>"; 
                                        }
                                    }
                        echo    "</div>
                        </div>";
                    echo "<div class='vertical-sm'></div>";
                    echo "</a>";
                }
            ?>
        </div>
    </div>
    <div class="vertical-sm"></div>
    <h6 class="font-white font-content">ADMINISTRATORS</h6>
    <div class="admin-list">
        <div class="content-blackbox">
            <?php 
                $query = $mysqli->query("SELECT * FROM users WHERE admin_rights = 1");
                
                while ($row = $query->fetch_array()){
                    echo "<a href='/Project/account/profile.php?id=".$row['userid']."'>";
                
                    echo    "<div class='vertical-sm'></div>
                            <div class='row'>
                                <div class='col-12'>";
                                    if ($row['image'] === ""){
                                        echo "<img src='/Project/images/default.png' alt='Default profile picture'/>";
                                        if ($row['userid'] === $_SESSION['userid']){
                                            echo "<span class='font-white font-content' style='padding-left: 20px;'>".$row['username']." (You)</span>";
                                        } else {
                                            echo "<span class='font-white font-content' style='padding-left: 20px;'>".$row['username']."</span>"; 
                                        }
                                    } else {
                                        echo "<img src='/Project/images/".$row['image']."' alt='Profile picture'/>";
                                        if ($row['userid'] === $_SESSION['userid']){
                                            echo "<span class='font-white font-content' style='padding-left: 20px;'>".$row['username']." (You)</span>";
                                        } else {
                                            echo "<span class='font-white font-content' style='padding-left: 20px;'>".$row['username']."</span>"; 
                                        }
                                    }
                        echo    "</div>
                        </div>";
                    echo "<div class='vertical-sm'></div>";
                    echo "</a>";
                }
            ?>
        </div>
    </div>
</div>