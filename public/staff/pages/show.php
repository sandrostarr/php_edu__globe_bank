<?php require_once ( __DIR__ . '/../../../private/initialize.php');

$id = $_GET['id'] ?? '1';

$page = find_page_by_id($id);

$page_title = 'Show Page';

include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
    <a href="<?php echo WWW_ROOT . '/staff/pages/index.php' ?>" class="back-link">&laquo; Back to list</a>
    <div class="page show">

        <h1>Page: <?php echo h($page['menu_name']); ?></h1>

        <div class="attributes">
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($page['menu_name']) ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($page['position']) ?></dd>
            </dl>
            <dl>
                <dt>Subject ID</dt>
                <dd><?php echo h($page['subject_id']) ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>
        </div>

    </div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php');