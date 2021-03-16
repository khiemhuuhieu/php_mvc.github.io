<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
<?php
if(isset($_GET['proid'])){
	$customer_id=session::get('customer_id');
	$proid=$_GET['proid'];
	$del_Wishlist=$product->del_Wishlist($customer_id,$proid);
}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Wishlist</h2>
						<table class="tblone">
							<tr>
								<th width="5%">STT</th>
								<th width="15%">Product Name</th>
								<th width="15%">Image</th>
								<th width="25%">Price</th>
								<th width="15%">Action</th>
							</tr>
							<?php
							$customer_id=session::get('customer_id');
							$show_wishlist =$product->show_wishlist($customer_id) ;
							if($show_wishlist){
								$i=0;
								while($result_wishlist=$show_wishlist->fetch_assoc()){
									$i++;
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $result_wishlist['product_name'];?></td>
								<td><img src="admin/upload/<?php echo $result_wishlist['images']?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result_wishlist['price'])."VNĐ";?></td>
								<td><a href="?proid=<?php echo $result_wishlist['product_id']?>">Remove</a>||
									<a href="detail.php?proid=<?php  echo $result_wishlist['product_id']?>">By Now</a>
								</td>
							</tr>
						<?php	
						}
					}
					?>
						</table>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php
include 'inc/footer.php';
?>