<?php 
require_once 'inc/session.php';
if(empty($_SESSION['fkl'])){
    header('location: login.php');
}

if(isset($_POST['submit'])){
    $file = $_POST['FILE'];
    // print_r($_POST);exit();
    $insert = "Insert into BLOB (ID,PIC) VALUES (1,empty_blob()) RETURNING PIC INTO :pic";
    $query = oci_parse($userView->link,$insert);
	$blob = oci_new_descriptor($userView->link, OCI_D_LOB);
	oci_bind_by_name($query, ":pic", $blob, -1, OCI_B_BLOB);
	oci_execute($query, OCI_DEFAULT) or die ("Unable to execute query");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="" method="post">
    <input type="file" name="FILE">
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>