<?php require_once (__DIR__ . '/../../private/initialize.php'); ?>

<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="content">
        <div id="main-menu">
            <h2>Main Menu</h2>
            <ul>
                <li><a href="<?php echo WWW_ROOT . '/staff/subjects/index.php' ?>">Subjects</a></li>
                <li><a href="<?php echo WWW_ROOT . '/staff/pages/index.php' ?>">Pages</a></li>
            </ul>
        </div>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>