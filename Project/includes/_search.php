<div class="col-4">
    <div class="content-blackbox">
        <!-- Search field -->
        <form method="post" class="search" autocomplete="off">
            <input type="text" class="form-control" name="search" placeholder="Search"/>
            <i class="search-icon font-white fa fa-search"></i>
        </form>
    </div>
    <div class="vertical-sm"></div>
    <div class="upload-link">
        <a href="/Project/code/upload.php">
            <!-- Submit code link -->
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
                // New users
                $query = $mysqli->query("SELECT * FROM users WHERE (admin_rights = 0 && partner_rights = 0) ORDER BY id DESC LIMIT 10");
                
                // Loop and display every row
                while ($row = $query->fetch_array()){ ?>
                    <a href="/Project/account/profile.php?id=<?php echo $row['userid']; ?>">
                        <div class="vertical-sm"></div>
                        <div class="row">
                            <div class="col-12">
                                <img src="/Project/images/<?php if ($row['image'] === "") { echo "default.png"; } else { echo $row['image']; }?>"/>
                                <span class='font-white font-content' style='padding-left: 20px;'><?php echo $row['username']; ?></span>
                            </div>
                        </div>  
                        <div class="vertical-sm"></div>
                    </a>
                <?php }
            ?>
        </div>
    </div>
    <div class="vertical-sm"></div>
    <h6 class="font-white font-content">SPONSORED</h6>
    <div class="partner-list">
        <div class="content-blackbox">
            <?php
                // Sponsors
                $query = $mysqli->query("SELECT * FROM users WHERE partner_rights = 1");
                
                // Loop and display every row
                while ($row = $query->fetch_array()){ ?>
                    <a href="/Project/account/profile.php?id=<?php echo $row['userid']; ?>">
                        <div class="vertical-sm"></div>
                        <div class="row">
                            <div class="col-12">
                                <img src="/Project/images/<?php if ($row['image'] === "") { echo "default.png"; } else { echo $row['image']; }?>"/>
                                <span class='font-white font-content' style='padding-left: 20px;'><?php echo $row['username']; ?></span>
                                <i class="fa fa-handshake-o"></i>
                            </div>
                        </div>
                        <div class="vertical-sm"></div>
                    </a>        
                <?php }
            ?>
        </div>
    </div>
    <div class="vertical-sm"></div>
    <h6 class="font-white font-content">ADMINISTRATORS</h6>
    <div class="admin-list">
        <div class="content-blackbox">
            <?php
                // Admin users
                $query = $mysqli->query("SELECT * FROM users WHERE admin_rights = 1");
                
                // Loop and display every row
                while ($row = $query->fetch_array()){ ?>
                    <a href="/Project/account/profile.php?id=<?php echo $row['userid']; ?>">
                        <div class="vertical-sm"></div>
                        <div class="row">
                            <div class="col-12">
                                <img src="/Project/images/<?php if ($row['image'] === "") { echo "default.png"; } else { echo $row['image']; }?>"/>
                                <span class='font-white font-content' style='padding-left: 20px;'><?php echo $row['username']; ?></span>
                            </div>
                        </div>
                        <div class="vertical-sm"></div>
                    </a>
                <?php }
            ?>
        </div>
    </div>
</div>