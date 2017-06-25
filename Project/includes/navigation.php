<!-- Side menu -->
<div style="position: fixed;">
    <div class="logo">
        <!-- Logo placeholder icon, NOT final -->
        <a href="/Project/index.php"><?php include ('logo.svg'); ?></a>
    </div>
    <div class="vertical-sm"></div>
    
    <!-- Search input field -->
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search">
    </div>
    
    <div class="vertical-sm"></div>
    
    <!-- Navigation menu -->
    <span class="font-grey_light font-header">INFORMATION</span>
    <div class="list-group">
        <a href="/Project/index.php" class="list-group-item <?php if ($active_page == "home") {echo "active"; }?>">Home</a>
        <a href="/Project/about.php" class="list-group-item <?php if ($active_page == "about") {echo "active"; }?>">About</a>
        <!-- <a href="/Project/contact.php" class="list-group-item <?php if ($active_page == "contact") {echo "active"; }?>">Contact</a> -->
    </div>
    
    <div class="vertical-sm"></div>
        
    <div class="divider-btm"></div>
    
    <div class="vertical-sm"></div>

    <?php 
        if($_SESSION['loggedin'] === true){
        ?>
            <!-- Content menu -->
            <span class="font-grey_light font-header">CONTENT</span>
            <div class="list-group">
                <a href="/Project/code/upload.php" class="list-group-item <?php if ($active_page == "upload") {echo "active"; }?>">Upload</a>
            </div>
            <div class="divider-btm"></div>
            
            <div class="vertical-sm"></div>
            
            
            <!-- More menu -->
            <span class="font-grey_light font-header">ACCOUNT</span>
            <div class="list-group">
                <a href="/Project/account/profile.php" class="list-group-item <?php if ($active_page == "profile") {echo "active"; }?>"><?php echo $_SESSION['username']; ?></a>
                <a href="/Project/account/logout.php" class="list-group-item">Logout</a>
            </div>
        <?php } else{ ?>
            <!-- More menu -->
            <span class="font-grey_light font-header">ACCOUNT</span>
            <div class="list-group">
                <a href="/Project/account/login.php" class="list-group-item <?php if ($active_page == "login") {echo "active"; }?>">Login</a>
                <a href="/Project/account/register.php" class="list-group-item <?php if ($active_page == "register") {echo "active"; }?>">Register</a>
            </div> 
        <?php
        }
    ?>
</div>