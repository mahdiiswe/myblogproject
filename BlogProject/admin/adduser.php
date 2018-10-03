<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if (!Session::get('userRole')=='0') { 
        echo "<script>window.location = 'index.php';</script>";
    }
 ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 

<?php 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
            
        $username = mysqli_real_escape_string($db->link, $fm->velidation($_POST['username']));
        $password = mysqli_real_escape_string($db->link, $fm->velidation(md5($_POST['password'])));
        $email    = mysqli_real_escape_string($db->link, $fm->velidation($_POST['email']));
        $role     = mysqli_real_escape_string($db->link, $fm->velidation($_POST['role']));

            if ($username == "" || $password == "" || $email == "" || $role == "") {
                echo "<span class = 'error'>Field must not be Empty!!</span>";
            }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<span class = 'error'>Invalid Email!!</span>";
            }else {
                $mailquery="select * from tbl_user where email='$email' limit 1";
                $chkmail = $db->select($mailquery);
                if ($chkmail != false) {
                     echo "<span class = 'error'>Email Alrady Exist!!</span>";
                }else{
                $query = "INSERT INTO tbl_user(username,password,email,role) VALUES('$username','$password','$email','$role')";
                $adduser = $db->insert($query);
                if ($adduser) {
                    echo "<span class = 'success'>User Crate Successfully.!!</span>";
                }else {
                    echo "<span class = 'error'>User not Created!!</span>";
                }
            }
          }  
            
  }          

?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Password</label> 
                            </td>
                            <td>                                 
                                <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                            </td>     
                            
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label> 
                            </td>
                            <td>                                 
                                <input type="text" name="email" placeholder="Enter Email..." class="medium" />
                            </td>     
                            
                        </tr>
                        <tr>
                            <td>
                                <label>User Role</label> 
                            </td>
                            <td>                                  
                                <select id="select" name="role">
                                    <option>Select Role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="2">Editor</option>
                                </select>
                            </td>     
                            
                        </tr>
						<tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>  
