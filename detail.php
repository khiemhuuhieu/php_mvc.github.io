<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
<?php
if(!isset($_GET['proid']) || $_GET['proid']==NULL)
{
  echo "<script>window.location='404.php' </script>";
}
else
{
  $id=$_GET['proid'];
}
?>
<?php
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['submit']))
{
	$quantity=$_POST['quantity'];
	$addtocart=$cart->add_to_cart($quantity,$id);
}
?>
<?php
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['compare'])){
	$customer_id=session::get('customer_id');
	$productid=$_POST['productid'];
	$insert_compare=$product->insert_compare($customer_id,$productid);
}
?>
<?php
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['wishlist'])){
	$customer_id=session::get('customer_id');
	$productid=$_POST['productid'];
	$insert_wishlist=$product->insert_wishlist($customer_id,$productid);
}
?>
<?php
if(isset($_POST['submit_binhluan'])){
	$binhluan=$customer->insert_commnet();
}
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
    		$show_pd_detail=$product->show_product_detail($id);
    		if($show_pd_detail){
    			while ($result=$show_pd_detail->fetch_assoc()) {

    		?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/upload/<?php echo $result['image']?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'];?></h2>
					<p><?php echo $result['product_desc'];?></p>					
					<div class="price">
						<p>Price: <span><?php echo $fm->format_currency($result['price'])."VNĐ"?></span></p>
						<p>Category: <span><?php echo $result['catName'];?></span></p>
						<p>Brand:<span><?php echo $result['brandName'];?></span></p>
					</div>
				<div class="add-cart">
					<?php
					if(isset($addtocart)){
						echo $addtocart;
					}
					?>	
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1" />
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>			
				</div>
				<div class="add-cart">
					<div class="button_details">
				<form action="" method="post">
				<input type="hidden" name="productid" value="<?php echo $result['productId']?>">
				<?php
	            $login_check=session::get('customer_login');
	            if($login_check==true){
	  	           echo '<input type="submit" name="compare" value="Compare Product" class="buysubmit">';
	            }
	           else{
	  	           echo '';
	           }
	           ?>
				</form>
				<form action="" method="post">
				<input type="hidden" name="productid" value="<?php echo $result['productId']?>">
				<?php
	            $login_check=session::get('customer_login');
	            if($login_check==true){
	  	           
	  	           echo '<input type="submit" name="wishlist" value="Save to wishlist" class="buysubmit">';
	            }
	           else{
	  	           echo '';
	           }	           
	           ?>
				</form>
			</div>
		</div>
			<div class="clear"></div>
			<p>
				<?php
					if (isset($insert_compare)) {
						echo  $insert_compare;
					}
			    ?>
			    <?php
					if (isset($insert_wishlist)) {
						echo  $insert_wishlist;
					}
				?>
			 </p>
			</div>
	
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['product_desc'];?></p>
	    </div>
				
	</div>
	      <?php
}
}
	      ?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2      >
					<?php
					$show_cate=$cate->show_cate_fe();
					if($show_cate){
		      				while($result_cate_fe=$show_cate->fetch_assoc()){
					?>
					<ul>
				      <li><a href="productbycat.php?catid=<?php echo $result_cate_fe['catId']?>"><?php echo $result_cate_fe['catName'];?></a></li>
    				</ul>
    				<?php 
    			}
    		}
    				?>
 				</div>
 		</div>
 		<div class="binhluan">
 			<div class="row">
 			<div class="col-md-8">
 			<h5>Đánh giá và ý kiến về sản phẩm</h5>
 			<?php
 			if(isset($binhluan)){
 				echo $binhluan;
 			}
 			?>
 			<form action="" method="POST">
 				<input type="hidden" name="product_id_binhluan" value="<?php echo $id?>">
 			<p><input type="text" class="form-control" name="tennguoibinhluan" placeholder="Tên của bạn.."></p>
 			<p><textarea rows="5" style="resize: none;" name="binhluan" class="form-control" placeholder="Bình luận về sản phẩm..."></textarea></p>
 			<input type="submit" name="submit_binhluan" class="btn btn-success" value="Gửi bình luận">
 		</form>
 		</div>
 	</div>
 		</div>
 	</div>
	
<?php
include 'inc/footer.php';
?>>

