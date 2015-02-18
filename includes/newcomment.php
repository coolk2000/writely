<?php
include_once 'db_connect.php';
include_once 'db_config.php';
include 'id_gen.php';

$error_msg = "";

if (isset($_POST['pageid'], $_POST['submitter'], $_POST['content'])) {
    // Sanitize and validate the data passed in
    $submitter = filter_input(INPUT_POST, 'submitter', FILTER_SANITIZE_STRING);
    $pageid = filter_input(INPUT_POST, 'pageid', FILTER_SANITIZE_STRING);
    $content = nl2br($_POST['content']);
    $lastedit = time();
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
 
    // check existing username
    /*$prep_stmt = "SELECT id FROM pages WHERE owner = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $pageid);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 1) {
                        // A user with this username already exists
                        $error_msg .= '<p class="error">A page with this ID already exists</p>';
                        $stmt->close();
                }
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
        }*/
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if (empty($error_msg)) {
 
        // Insert the new page into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO pages (submitter, pageid, content, lastedit) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('sssi', $submitter, $pageid, $content, $lastedit);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../errors/error.php?err=creation failure: INSERT');
            }
        }
        // Do stuff
    }
}