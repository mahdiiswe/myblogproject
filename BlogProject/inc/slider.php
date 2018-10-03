<div class="slidersection templete clear">
        <div id="slider">
        	<?php 
					$query = "select * from tbl_slider order by id limit 5";
					$slider = $db->select($query);
					if ($slider) {
						while ($result = $slider->fetch_assoc()) {
					
					?>
            <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="nature 1" title="<?php echo $result['title']; ?>" />
            </a>
		<?php } } ?>
            
        </div>

</div>