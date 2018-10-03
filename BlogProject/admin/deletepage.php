<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>
<?php
        $db = new Database();
       
?>

<?php 
    include '../lib/Session.php';
    Session::checkSession();
?>
<?php 

if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL ) {
    echo "<script>window.location = 'index.php';</script>";
    //header("Location:postlist.php");
}else {
    $getpageid = $_GET['delpage'];

    $delquery = "delete from tbl_page where id='$getpageid'";
    $queryresult = $db->delete($delquery);
    if ($queryresult) {
    	echo "<script>alart('Page Deleted Successfully.');</script>";
    	echo "<script>window.location = 'index.php';</script>";
    }else {
    	echo "<script>alart('Page Not Deleted');</script>";
    	echo "<script>window.location = 'index.php';</script>";
    }
}

?>