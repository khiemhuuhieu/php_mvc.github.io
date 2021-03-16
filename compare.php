<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare</h2>
						<table class="tblone">
							<tr>
								<th width="5%">STT</th>
								<th width="15%">Product Name</th>
								<th width="15%">Image</th>
								<th width="25%">Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							$customer_id=session::get('customer_id');
							$show_compare =$product->show_compare($customer_id) ;
							if($show_compare){
								$i=0;
								while($result_compare=$show_compare->fetch_assoc()){
									$i++;
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $result_compare['product_name'];?></td>
								<td><img src="admin/upload/<?php echo $result_compare['image']?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result_compare['price'])."VNĐ";?></td>
								<td><a href="detail.php?proid=<?php echo $result_compare['product_id']?>">View</a>
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