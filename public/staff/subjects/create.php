<?php
require_once(__DIR__ . '/../../../private/initialize.php');

if(is_post_request()) {

$subject = [];
$subject['menu_name'] = $_POST['menu_name'] ?? '';
$subject['position'] = $_POST['position'] ?? '';
$subject['visible'] = $_POST['visible'] ?? '';

$result = insert_subject($subject);
$new_id = mysqli_insert_id($db);
redirect_to(WWW_ROOT . '/staff/subjects/show.php?id=' . $new_id);

} else {
    redirect_to(WWW_ROOT . '/staff/subjects/new.php');
}