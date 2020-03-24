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

    $sql = "SELECT * FROM subjects WHERE id='" . db_escape($id) . "'";
    echo $sql;
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

    $sql = "INSERT INTO subjects (menu_name, position, visible) VALUES ( '" . db_escape($subject['menu_name']) . "', '" . db_escape($subject['position']) . "', '" . db_escape($subject['visible']) . "')";
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

    $sql = "UPDATE subjects SET menu_name = '" . db_escape($subject['menu_name']) . "', position = '" . db_escape($subject['position']) . "', visible = '" . db_escape($subject['visible']) . "' WHERE id = '" . db_escape($subject['id']) . "' LIMIT 1";

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

    $sql = "DELETE FROM subjects WHERE id = '" . db_escape($id) . "' LIMIT 1";

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

    $sql = "SELECT * FROM pages WHERE id='" . db_escape($id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page; //returns an assoc array
}

function insert_page($page) {
    global $db;

    $errors = validate_page($page);
    if(!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO pages (menu_name, position, visible, subject_id) VALUES ( '" . db_escape($page['menu_name']) . "', '" . db_escape($page['position']) . "', '" . db_escape($page['visible']) . "', '" . db_escape($page['subject_id']) . "')";
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

    $errors = validate_page($page);
    if(!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE pages SET menu_name = '" . db_escape($page['menu_name']) . "', position = '" . db_escape($page['position']) . "', visible = '" . db_escape($page['visible']) . "', subject_id = '" . db_escape($page['subject_id']) . "' WHERE id = '" . db_escape($page['id']) . "' LIMIT 1";

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

    $sql = "DELETE FROM pages WHERE id = '" . db_escape($id) . "' LIMIT 1";

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

function validate_page($page) {

    $errors = [];

    // subject_id
    if(is_blank($page['subject_id'])) {
        $errors[] = "Subject cannot be blank.";
    }

    // menu_name
    if(is_blank($page['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }

    // menu_name unique
    $unique = has_unique_page_menu_name($page);
    if($unique['total'] != 0) {
        $errors[] = "Name must be unique.";

    }
    // position
    // Make sure we are working with an integer
    $position_int = (int) $page['position'];
    if($position_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if($position_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // subject_id
    // Make sure we are working with an integer
    $subject_id_int = (int) $page['subject_id'];
    if($subject_id_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}
