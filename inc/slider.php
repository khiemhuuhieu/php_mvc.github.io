	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
				$show_pd_app=$product->show_top_app();
				if($show_pd_app){
					while($result_app=$show_pd_app->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="detail.php?proid=<?php echo $result_app['productId']?>"> <img src="admin/upload/<?php echo $result_app['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result_app['productName'];?></h2>
						<p><?php echo $fm->textShorten($result_app['product_desc'],20);?></p>
						<div class="button"><span><a href="detail.php?proid=<?php echo $result_app['productId']?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php
			}
		}
			   ?>
			   

			   <?php
			   $show_pd_dell=$product->show_top_dell();
			   if($show_pd_dell){
			   	while($result_dell=$show_pd_dell->fetch_assoc()){
			   ?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="detail.php?proid=<?php echo $result_app['productId']?>"><img src="admin/upload/<?php echo $result_dell['image']?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2><?php echo $result_dell['productName'];?></h2>
						  <p><?php echo  $fm->textShorten($result_dell['product_desc'],20);?></p>
						  <div class="button"><span><a href="detail.php?proid=<?php echo $result_dell['productId']?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php
			}
		}
				?>
			</div>
			<div class="section group">
				<?php
				  $show_pd_sony=$product->show_top_sony();
			         if($show_pd_sony){
			   	     while($result_sony=$show_pd_sony->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="detail.php?proid=<?php echo $result_sony['productId']?>"> <img src="admin/upload/<?php echo $result_sony['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result_sony['productName'];?></h2>
						<p><?php echo $fm->textShorten($result_sony['product_desc'],20);?></p>
						<div class="button"><span><a href="detail.php?proid=<?php echo $result_sony['productId']?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php
			}
		}
			   ?>
			   <?php
			     $show_pd_ss=$product->show_top_ss();
			   if($show_pd_ss){
			   	while($result_ss=$show_pd_ss->fetch_assoc()){

			   ?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="detail.php?proid=<?php echo $result_ss['productId']?>"><img src="admin/upload/<?php echo $result_ss['image']?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2><?php echo $result_ss['productName'];?></h2>
						  <p><?php echo $fm->textShorten($result_ss['product_desc'],20);?></p>
						  <div class="button"><span><a href="detail.php?proid=<?php echo $result_ss['productId']?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php
			}
		}
				?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
							<?php
				  	$show_slider=$product->show_slider_index();
				  	if($show_slider){
				  		while ($result=$show_slider->fetch_assoc()) {
				  
				  	?>
						<li><img src="admin/upload/<?php echo $result['sliderImages']?>" alt=""/></li>
						    <?php
				}
			}
				    ?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>