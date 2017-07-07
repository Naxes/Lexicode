<div class="logo">
    <a href="/Project/index.php">
        <i class="fa fa-home"></i>
    </a>
</div>
<div class="horizontaline-sm"></div>
<div class="vertical-sm"></div>
<ul>
    <a href="/Project/index.php?sort=new<?php if (isset($_GET['page'])) { echo "&page=".$_GET['page'].""; } ?>" class="<?php if ($_GET['sort'] == "new"){echo "active"; } ?>">
        <i class="content-icons fa fa-sort-numeric-desc"></i>
        <li>New</li>
    </a>
    <a href="/Project/index.php?sort=old<?php if (isset($_GET['page'])) { echo "&page=".$_GET['page'].""; } ?>" class="<?php if ($_GET['sort'] == "old"){echo "active"; } ?>">
        <i class="content-icons fa fa-sort-numeric-asc"></i>
        <li>Old</li>
    </a>
    <a href="/Project/index.php?sort=top<?php if (isset($_GET['page'])) { echo "&page=".$_GET['page'].""; } ?>" class="<?php if ($_GET['sort'] == "top"){echo "active"; } ?>">
        <i class="content-icons fa fa-trophy"></i>
        <li>Top</li>
    </a>
</ul>