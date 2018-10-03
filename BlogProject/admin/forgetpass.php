<?php 
	include '../lib/Session.php';
	Session::checkLogin();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>
<?php
		$db = new Database();
		$fm = new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

	<?php 
		if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$email = mysqli_real_escape_string($db->link, $fm->velidation($_POST['email']));

		if ($email == "") {
                echo "<span style='color:red;font-size:18px;'>Field Must Not Be Empty!!</span>";
            }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<span style='color:red;font-size:18px;'>Invalid Email!!</span>";
            }else {
                $mailquery="select * from tbl_user where email='$email' limit 1";
                $chkmail = $db->select($mailquery);
			
			if ($chkmail != false) {
				while ($value = $chkmail->fetch_assoc()) {
				    $userid = $value['id'];
				    $username = $value['username'];
				}
				$text = substr($email, 0,3);
				$rand = rand(10000, 99999);
				$newpass = "$text$rand";
				$password = md5($newpass);

				$query = "UPDATE tbl_user
                        SET
                        password = '$password'
                        WHERE id = '$userid' ";
                $update_user = $db->update($query);

                $to = "$email";
                $from = "info@blog.com";
                $headers = "From: $from\n";
                $headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$subject = "Your Password";
				$message = "Your Username is ".$username." and Password is ".$newpass.". please visit website to login.";

                $mailsend=mail($to, $subject, $message, $headers);

                if ($mailsend) {
                echo "<span style='color:red;font-size:18px;'>Please Check your Email for new Password.</span>";
                  
                }else {
                	echo "<span style='color:red;font-size:18px;'>Something Went Wrong</span>";
                    
                }
				
				

			}else {
				echo "<span style='color:red;font-size:18px;'>Email Not Exist!!</span>";
			}
		}
	}	

	?>

		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Your Email..." name="email"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>