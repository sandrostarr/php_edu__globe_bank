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
    $errors = validate_subject($subject);
    if(!empty($errors)) {
        return $errors;
    }

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

    $errors = validate_subject($subject);
    if(!empty($errors)) {
        return $errors;
    }

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

function update_page($page) {
    global $db;

    $sql = "UPDATE pages SET menu_name = '" . $page['menu_name'] . "', position = '" . $page['position'] . "', visible = '" . $page['visible'] . "', subject_id = '" . $page['subject_id'] . "' WHERE id = '" . $page['id'] . "' LIMIT 1";

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

    $sql = "DELETE FROM pages WHERE id = '" . $id . "' LIMIT 1";

    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function validate_subject($subject) {

    $errors = [];

    // menu_name
    if(is_blank($subject['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $subject['position'];
    if($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}
