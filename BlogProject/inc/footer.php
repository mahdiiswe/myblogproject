</div>

	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
	  <?php 
                $query = "select * from tbl_copyright where id='1'";
                $copy_right = $db->select($query);
                if ($copy_right) {
                    while ($result = $copy_right->fetch_assoc()) {
              
                ?>
	  <p>&copy; <?php echo $result['note'] ;?> <?php echo date('Y'); ?></p>
	  <?php } } ?>
	</div>
	<div class="fixedicon clear">

			<?php 
                $query = "select * from tbl_social where id='1'";
                $social_link = $db->select($query);
                if ($social_link) {
                    while ($result = $social_link->fetch_assoc()) {
                ?> 
		<a href="<?php echo $result['fb'] ;?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $result['tw'] ;?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $result['ln'] ;?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $result['gp'] ;?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>

		<?php } } ?>

	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>