<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>

             <?php 
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $note    = mysqli_real_escape_string($db->link, $fm->velidation($_POST['note']));

            if ($note == "") {
                echo "<span class = 'error'>Field must not be empty!!</span>";
            }else {
                $query = "UPDATE tbl_copyright
                       SET
                       note   = '$note'
                      WHERE id = '1'";

            $updated_rows = $db->update($query);
            if ($updated_rows) {
             echo "<span class='success'>Data Updated Successfully.</span>";
            }else {
             echo "<span class='error'>Data Not Updated !</span>";
            }
            }

        }
        ?>

                <div class="block copyblock">

                <?php 
                $query = "select * from tbl_copyright where id='1'";
                $copy_right = $db->select($query);
                if ($copy_right) {
                    while ($result = $copy_right->fetch_assoc()) {
              
                ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value= "<?php echo $result['note']; ?>" name="note" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    
                    <?php } } ?>

                </div>
            </div>
        </div>
        
<?php include 'inc/footer.php'; ?> 
