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

if (!isset($_GET['delsliderid']) || $_GET['delsliderid'] == NULL ) {
    echo "<script>window.location = 'sliderlist.php';</script>";
    //header("Location:postlist.php");
}else {
    $getsliderid = $_GET['delsliderid'];

    $query = "select * from tbl_slider where id='$getsliderid'";
    $getresult = $db->select($query);
    if ($getresult) {
    	while ($delimg = $getresult->fetch_assoc()) {
    	    $dellink = $delimg['image'];
    	    unlink($dellink);
    	}
    }

    $delquery = "delete from tbl_slider where id='$getsliderid'";
    $queryresult = $db->delete($delquery);
    if ($queryresult) {
    	echo "<script>alart('Data Deleted Successfully.');</script>";
    	echo "<script>window.location = 'sliderlist.php';</script>";
    }else {
    	echo "<script>alart('Data Not Deleted');</script>";
    	echo "<script>window.location = 'sliderlist.php';</script>";
    }
}

?>