<?php 

function find_all_subjects() {
    global $db;

    $sql = "SELECT * FROM subjects ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_subject_by_id($id) {
    global $db;

    $sql = "SELECT * FROM subjects WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql); 
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; //returns an assoc array
}

function insert_subject($subject) {
    global $db;

    $sql = "INSERT INTO subjects (menu_name, position, visible) VALUES ( '" . $subject['menu_name'] . "', '" . $subject['position'] . "', '" . $subject['visible'] . "')";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    }
    else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

function update_subject($subject) {
    global $db;

    $sql = "UPDATE subjects SET menu_name = '" . $subject['menu_name'] . "', position = '" . $subject['position'] . "', visible = '" . $subject['visible'] . "' WHERE id = '" . $subject['id'] . "' LIMIT 1";

    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_subject($id) {
    global $db;

    $sql = "DELETE FROM subjects WHERE id = '" . $id . "' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_all_pages() {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "ORDER BY subject_id ASC, position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_page_by_id($id) {
    global $db;

    $sql = "SELECT * FROM pages WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page; //returns an assoc array
}

function insert_page($page) {
    global $db;

    $sql = "INSERT INTO pages (menu_name, position, visible, subject_id) VALUES ( '" . $page['menu_name'] . "', '" . $page['position'] . "', '" . $page['visible'] . "', '" . $page['subject_id'] . "')";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    }
    else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

function update_page($subject) {
    global $db;

    $sql = "UPDATE subjects SET menu_name = '" . $subject['menu_name'] . "', position = '" . $subject['position'] . "', visible = '" . $subject['visible'] . "' WHERE id = '" . $subject['id'] . "' LIMIT 1";

    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_page($id) {
    global $db;

    $sql = "DELETE FROM subjects WHERE id = '" . $id . "' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}