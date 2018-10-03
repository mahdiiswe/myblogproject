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

if (!isset($_GET['delpostid']) || $_GET['delpostid'] == NULL ) {
    echo "<script>window.location = 'postlist.php';</script>";
    //header("Location:postlist.php");
}else {
    $getpostid = $_GET['delpostid'];

    $query = "select * from tbl_post where id='$getpostid'";
    $getresult = $db->select($query);
    if ($getresult) {
    	while ($delimg = $getresult->fetch_assoc()) {
    	    $dellink = $delimg['image'];
    	    unlink($dellink);
    	}
    }

    $delquery = "delete from tbl_post where id='$getpostid'";
    $queryresult = $db->delete($delquery);
    if ($queryresult) {
    	echo "<script>alart('Data Deleted Successfully.');</script>";
    	echo "<script>window.location = 'postlist.php';</script>";
    }else {
    	echo "<script>alart('Data Not Deleted');</script>";
    	echo "<script>window.location = 'postlist.php';</script>";
    }
}

?>