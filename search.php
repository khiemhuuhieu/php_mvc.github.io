<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
 <div class="main">
    <div class="content">
    	<?php
          if($_SERVER['REQUEST_METHOD']=='POST'){
	        $tukhoa=$_POST['tukhoa'];
	        $search_pd=$product->search_product($tukhoa);
            }
         ?>
    	<div class="content_top">
    		<div class="heading">
    		<h3>Từ khóa tìm kiếm là: <?php echo $tukhoa;?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      	if($search_pd){
	      		while ($result_pd_cate=$search_pd->fetch_assoc()) {
	      			
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
