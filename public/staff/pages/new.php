<?php require_once(__DIR__ . '/../../../private/initialize.php'); 

$menu_name = '';
$position = '';
$visible = '';

if(is_post_request()) {
$menu_name = $_POST['menu_name'] ?? '';
$position = $_POST['position'] ?? '';
$visible = $_POST['visible'] ?? '';

echo 'Form Parameters: <br>';
echo 'Menu name: ' . $menu_name . '<br>';
echo 'Position: ' . $position . '<br>';
echo 'Visible: ' . $visible . '<br>';

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
                <option value="1" <?php if($position == 1) echo 'selected'; ?> >1</option>
                <option value="2" <?php if($position == 2) echo 'selected'; ?> >2</option>
                <option value="3" <?php if($position == 3) echo 'selected'; ?> >3</option>
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