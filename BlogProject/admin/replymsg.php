<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php 

if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL ) {
    echo "<script>window.location = 'inbox.php';</script>";
    //header("Location:catlist.php");
}else {
    $id = $_GET['msgid'];
}

?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>

        <?php 
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $to  = mysqli_real_escape_string($db->link, $fm->velidation($_POST['toemail']));
        $from = mysqli_real_escape_string($db->link, $fm->velidation($_POST['fromemail']));  
        $subject  = mysqli_real_escape_string($db->link, $fm->velidation($_POST['subject']));  
        $message  = mysqli_real_escape_string($db->link, $fm->velidation($_POST['msg']));    

        $mailsend=mail($to, $subject, $message, $from);
        if ($mailsend) {
                    echo "<span class = 'success'>Mail Sent Successfully.!!</span>";
                }else {
                    echo "<span class = 'error'>Something Went Wrong!!</span>";
                }
            }
        

        ?>

                <div class="block">   

                <?php 
                    $query = "select * from tbl_contact where id='$id' order by id desc";
                    $msgbyid = $db->select($query);
                    if ($msgbyid) {
                        while ($result = $msgbyid->fetch_assoc()) {

            ?>            
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name="toemail" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromemail" placeholder="Enter Your Email Address..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="Enter Your Subject..." class="medium" />
                            </td>
                        </tr>

                     
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="msg"></textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>

 <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
<!-- Load TinyMCE -->  

<?php include 'inc/footer.php'; ?> 


