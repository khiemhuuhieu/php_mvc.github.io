<?php
include 'inc/header.php';
include 'inc/slider.php';
?>	

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      	$show_pd_faeture=$product->show_product_feture();
	      	if($show_pd_faeture){
	      	while ($result=$show_pd_faeture->fetch_assoc()) {
	      	 	
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="detail.php"><img src="admin/upload/<?php echo $result['image']?>"height="160px" alt=""/></a>
					 <h2><?php echo $result['productName']?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'],50) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['price'])."VNĐ";?></span></p>
				     <div class="button"><span><a href="detail.php?proid=<?php echo $result['productId']?>" class="details">Details</a></span></div>
				</div>
			<?php
		}
      }
			?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
	      	$show_pd_new=$product->show_product_new();
	      	if($show_pd_new){
	      	while ($result_new=$show_pd_new->fetch_assoc()) {
	      	 	
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="detail.php"><img src="admin/upload/<?php echo $result_new['image']?>" height="160px" alt="" /></a>
					 <h2><?php echo $fm->textShorten($result_new['product_desc'],50);?></h2>
					 <p><span class="price"><?php echo $fm->format_currency($result_new['price'])."VND";?></span></p>
				     <div class="button"><span><a href="detail.php?proid=<?php echo $result_new['productId']?>" class="details">Details</a></span></div>
				</div>
				<?php
			}
		}
				?>
			</div>
			<div class="phantrang">
				<?php
				$show_pr_all=$product->show_product_all();
				$pd_count=mysqli_num_rows($show_pr_all);
				$pd_trang=ceil($pd_count/4);
				$i=1;
				echo '<p>Trang:</p>';
				for($i=1;$i<$pd_trang;$i++){
					echo '<a style="color:red;margin-left:20px" href="index.php?trang='.$i.'">'.$i.'</a>';
				}
				?>
			</div>
    </div>
 </div>
<?php
include 'inc/footer.php';
?>
