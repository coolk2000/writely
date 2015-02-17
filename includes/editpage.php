<?php
include_once 'db_connect.php';
include_once 'db_config.php';
include 'id_gen.php';

$error_msg = "";
 
if (isset($_POST['title'], $_POST['id'])) {
    // Sanitize and validate the data passed in
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $id = $_POST['id'];
    $lastedit = time();
    
    if (isset($_POST['private'])) {
      if ($_POST['private'] == "1") {
        $private = '1';
        }
    } else {
        $private = '0';
    }

    if (isset($_POST['contents'])) {
        $contents = filter_input(INPUT_POST, 'contents', FILTER_SANITIZE_STRING);
    } else {
        $contents = "";
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
 
    // check existing username
    /*$prep_stmt = "SELECT id FROM pages WHERE owner = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $title);
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
        if ($insert_stmt = $mysqli->prepare("UPDATE pages SET title = ?, private = ?, lastedit = ? WHERE id = ?")) {
            $insert_stmt->bind_param('siis', $title, $private, $lastedit, $id);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../errors/error.php?err=creation failure: INSERT');
            }
        }
        // Create the blank page file
        $pagefile = fopen("../page_files/".$id.".txt", "w");
        fwrite($pagefile, $contents);
        fclose($pagefile);
        header('Location: ../page/view/'.$id.'');
    }
}