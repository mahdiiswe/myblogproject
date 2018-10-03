<?php include 'inc/header.php'; ?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname  = mysqli_real_escape_string($db->link, $fm->velidation($_POST['firstname']));
    $lastname    = mysqli_real_escape_string($db->link, $fm->velidation($_POST['lastname']));
    $body   = mysqli_real_escape_string($db->link, $fm->velidation(strip_tags($_POST['body'])));
    $email   = mysqli_real_escape_string($db->link, $fm->velidation($_POST['email']));

    $error="";
    $msg="";

    if (empty( $firstname)) {
    	$error="First Name Must Not Be Empty."; 
    }elseif (empty( $lastname)) {
    	$error="Last Name Must Not Be Empty."; 
    }elseif (empty( $email)) {
    	$error="Email Must Not Be Empty."; 
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    	$error="Invalid Email Address.";
    }elseif (empty( $body)) {
    	$error="Body Must Not Be Empty.";
    }else{
    		$query = "INSERT INTO tbl_contact(firstname,lastname,email,body) VALUES('$firstname','$lastname','$email','$body')";
                $contact_msg = $db->insert($query);
                if ($contact_msg) {
                    $msg="Message Sent Successfully.";
                }else {
                    $error="Message Not Sent.";
                }
    	}	

     }
 ?>           

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php 
				if (isset($error)) {
					echo "<span style='color:red;'>$error</span>";
				}if (isset($error)) {
					echo "<span style='color:green;'>$msg</span>";
				}
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name"/>
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name"/>
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="text" name="email" placeholder="Enter Email Address"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

	</div>
		<?php include 'inc/sidebar.php'; ?>
		<?php include 'inc/footer.php'; ?> 