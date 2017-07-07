<div class="logo">
    <?php 
        $query = $mysqli->query("SELECT * FROM users WHERE userid = '".$_SESSION['userid']."'");
        $user = $query->fetch_assoc();
        
        if ($_SESSION['loggedin'] === true){
            if ($user['image'] === ""){
                echo "<a href='/Project/account/profile.php?id=".$_SESSION['userid']."'><img width='100%' height='100%' src='/Project/images/default.png' alt='Default profile picture'/></a>";    
            } else {
                echo "<a href='/Project/account/profile.php?id=".$_SESSION['userid']."'><img src='/Project/images/".$user['image']."' alt='Profile picture'/></a>";
            }
        } else { ?>
            <span class="font-white fa fa-user-circle-o"></span>   
        <?php }
    ?>
</div>
<div class="horizontaline-sm"></div>
<div class="vertical-sm"></div>
<ul>
    <a href="/Project/about.php" class="<?php if ($active_page == "about"){ echo "active";} ?>">
        <i class="fa fa-info"></i>
    </a>
    <?php if ($_SESSION['loggedin'] === true){
        ?>
        <a href="/Project/account/profile.php?id=<?php echo $_SESSION['userid']; ?>" class="<?php if ($active_page == "profile" && $_GET['id'] == $_SESSION['userid']) {echo "active"; }?>">
            <i class="fa fa-user"></i>
        </a>
        <?php if ($user['admin_rights'] === "0"){ ?>
            <a href="/Project/code/upload.php" class="<?php if ($active_page == "upload") {echo "active"; }?>">
                <i class="fa fa-upload"></i>
            </a>    
        <?php } ?>
        <a href="/Project/account/edit/details.php?id=<?php echo $_SESSION['userid']; ?>" class="<?php if ($active_page == "details") {echo "active"; }?>">
            <i class="fa fa-cog"></i>
        </a>
        <?php if ($user['admin_rights'] === "1"){ ?>
            <a href="/Project/admin/control-panel.php" class="<?php if ($active_page == "admin") {echo "active"; }?>">
                <i class="fa fa-shield"></i>
            </a>
        <?php } ?>
        <a href="/Project/account/logout.php">
            <i class="fa fa-sign-out"></i>
        </a>
    <?php }else{ 
            ?>
            <a href="/Project/account/register.php" class="<?php if ($active_page == "register"){echo "active";} ?>">
                <i class="fa fa-user-plus"></i>
            </a>
            <a href="/Project/account/login.php" class="<?php if ($active_page == "login"){echo "active";} ?>">
                <i class="fa fa-sign-in"></i>
            </a>
    <?php }?>
</ul>