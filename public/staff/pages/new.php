<?php require_once(__DIR__ . '/../../../private/initialize.php');

$subject_set = find_all_subjects();
$subject_count = mysqli_num_rows($subject_set);
mysqli_free_result($subject_set);

$page_set = find_all_pages();
$page_count = mysqli_num_rows($page_set) + 1;
mysqli_free_result($page_set);

$page = [];
$page['position'] = $page_count;

if(is_post_request()) {

    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';

    $result = insert_page($page);
    $new_id = mysqli_insert_id($db);
    redirect_to(WWW_ROOT . '/staff/pages/show.php?id=' . $new_id);

} 
?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT . '/staff/pages/index.php'; ?>">&laquo; Back to List</a>

  <div class="page new">
    <h1>Create Page</h1>

    <form action="<?php echo WWW_ROOT . '/staff/pages/new.php'; ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($menu_name) ?>" /></dd>
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
                        if($subject["position"] == $i) {
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
          <input type="checkbox" name="visible" value="1" <?php if($visible == 1) echo 'checked'; ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>

  </div>

</div>