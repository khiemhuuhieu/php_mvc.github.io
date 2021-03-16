<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
<?php
if(!isset($_GET['catid']) || $_GET['catid']==NULL){
	echo "<script>window.location:'404.php'</script>";
}
else
{
	$id=$_GET['catid'];
}
?>
 <div class="main">
    <div class="content">
    	<?php
    	$show_name_cate=$cate->show_titile_cate($id);
    	if($show_name_cate){
    	while($result_name=$show_name_cate->fetch_assoc()){ 
    	?>
    	<div class="content_top">
    		<div class="heading">
    		<h3>Category: <?php echo $result_name['catName'];?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    	<?php
    }
}
    	?>
	      <div class="section group">
	      	<?php
	      	$show_pd_cate=$cate->show_pr_cate($id);
	      	if($show_pd_cate){
	      		while ($result_pd_cate=$show_pd_cate->fetch_assoc()) {
	      			
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="detail.php"><img src="admin/upload/<?php echo $result_pd_cate['image']?>" alt="" /></a>
					 <h2><?php echo $result_pd_cate['productName'];?></h2>
					 <p><?php echo $fm->textShorten($result_pd_cate['product_desc'],30);?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result_pd_cate['price']).'VNĐ';?></span></p>
				     <div class="button"><span><a href="detail.php?proid=<?php echo $result_pd_cate['productId']?>" class="details">Details</a></span></div>
				</div>
				<?php
			}
		  }else{
		  	echo "san pham dang cap nhat";
		  }

				?>
			</div>
    </div>
 </div>
<?php
include 'inc/footer.php';
?>
