    <?php include 'inc/header.php'; ?>
    <?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Change Password</h2>
                <div class="block"> 
                <?php 

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $oldpass = mysqli_real_escape_string($db->link, $fm->velidation(md5($_POST['oldpass'])));
    $newpass = mysqli_real_escape_string($db->link, $fm->velidation(md5($_POST['newpass'])));   

            if ($oldpass == "" || $newpass == "") {
                echo "<span class = 'error'>Field must not be Empty!!</span>";
            }
            elseif (Session::get('userPass')==$oldpass) {
              $querynew="UPDATE tbl_user
                              SET
                              password='$newpass' ";
                    $updated_rows = $db->update($query);
                        if ($updated_rows) {
                         echo "<span class='success'>Password Updated Successfully.</span>";
                        }else {
                         echo "<span class='error'>Password Not Updated !</span>";
                        }  
            }else{
                 echo "<span class = 'error'>Old Password is not matched.</span>";
                    }   
               }
                

                ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Old Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter Old Password..."  name="oldpass" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>New Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter New Password..." name="newpass" class="medium" />
                            </td>
                        </tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        
<?php include 'inc/footer.php'; ?>  
