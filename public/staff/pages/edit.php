<?php require_once(__DIR__ . '/../../../private/initialize.php'); 

if (!isset($_GET['id'])) {
    redirect_to(WWW_ROOT . '/staff/pages/edit.php');
} 

$id = $_GET['id'];

$page = find_page_by_id($id);

$subject_set = find_all_subjects();
$subject_count = mysqli_num_rows($subject_set);
mysqli_free_result($subject_set);

$page_set = find_all_pages();
$page_count = mysqli_num_rows($page_set);
mysqli_free_result($page_set);

if(is_post_request()) {

    $page = [];
    $page['id'] = $id;
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    $result = update_page($page);
    if($result === true) {
        redirect_to(    WWW_ROOT . '/staff/pages/show.php?id=' . $id);
    } else {
        $errors = $result;
    }
} else {


}
?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo WWW_ROOT . '/staff/pages/index.php'; ?>">&laquo; Back to List</a>

    <div class="page edit">
        <h1>Edit Subject</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo WWW_ROOT . '/staff/pages/edit.php?id=' . h(u($id)); ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php
                        for($i=1; $i <= $page_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if($page["position"] == $i) {
                                echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Subject ID</dt>
                <dd>
                    <select name="subject_id">
                        <?php
                        for($i=1; $i <= $subject_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if($page["subject_id"] == $i) {
                                echo " selected";
                            }
                            $subject = find_subject_by_id($i);
                            echo ">{$subject['menu_name']}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" <?php if($page['visible'] == 1) echo 'checked'; ?> />
                </dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd>
                    <textarea rows="10" cols="45" name="content"><?php echo h($page['content']); ?></textarea>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Page" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>