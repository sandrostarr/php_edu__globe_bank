<?php
require_once(__DIR__ . '/../../../private/initialize.php');

if(is_post_request()) {
$menu_name = $_POST['menu_name'] ?? '';
$position = $_POST['position'] ?? '';
$visible = $_POST['visible'] ?? '';

echo 'Form Parameters: <br>';
echo 'Menu name: ' . $menu_name . '<br>';
echo 'Position: ' . $position . '<br>';
echo 'Visible: ' . $visible . '<br>';

} else {
    redirect_to(WWW_ROOT . '/staff/subjects/new.php');
}