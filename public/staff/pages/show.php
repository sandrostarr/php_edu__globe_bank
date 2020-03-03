<?php require_once ( __DIR__ . '/../../../private/initialize.php');

$id = $_GET['id'] ?? '1';

$page_title = 'Show Page';

include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
    <a href="<?php echo WWW_ROOT . '/staff/pages/index.php' ?>" class="back-link">&laquo; Back to list</a>
</div>

<div class="page show">
    Subject ID: <?php echo h($id); ?>
</div>

<?php include(SHARED_PATH . '/staff_footer.php');