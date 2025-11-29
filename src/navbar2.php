<?php
$current = basename($_SERVER['PHP_SELF']);
?>
<header>
    <a href="home2.php">MENE</a>
    <nav>
        <a href="home2.php" class="<?= $current === 'home2.php' ? 'active' : '' ?>">HOME</a>
        <a href="form.php" class="<?= $current === 'form.php' ? 'active' : '' ?>">FORM COLLECTION</a>
        <a href="about.php" class="<?= $current === 'about.php' ? 'active' : '' ?>">ABOUT</a>
        <a href="overview.php" class="<?= $current === 'overview.php' ? 'active' : '' ?>">OVERVIEW</a>
        <a href="logout.php" class="<?= $current === 'logout.php' ? 'active' : '' ?>">LOG OUT</a>
    </nav>
</header>  