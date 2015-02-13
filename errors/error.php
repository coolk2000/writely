<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
 
if (! $error) {
    $error = 'unknown error';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>writely; login error</title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <body>
        <h1>error</h1><small><?php echo $error; ?></small>  
    </body>
</html>