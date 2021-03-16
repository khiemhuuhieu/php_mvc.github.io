<?php

include 'inc/header.php';
//include 'inc/slider.php';
?>
<?php
      $login_check=session::get('customer_login');
	  if($login_check==false){
	  	header('location:login.php');
	  }
?> 
<?php
if(isset($_GET['confirmid']))
{
	$id=$_GET['confirmid'];
	$price=$_GET['price'];
	$order_date=$_GET['order_date'];
	$confirm_shifted=$cart->confirm_shifted($id,$price,$order_date);
}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your details Cart</h2>
						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="30%">Product Name</th>
								<th width="15%">Total</th>
								<th width="10%">Quantity</th>
								<th width="20%">Date</th>
								<th width="10%">Status</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							$customer_id=session::get('customer_id');
							$show_order=$cart->show_order($customer_id);
							if($show_order){
								$i=0;
								$qty=0;
								while($result_order=$show_order->fetch_assoc()){
									$i++;
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $result_order['productName'];?></td>
								<td><?php echo $fm->format_currency($result_order['price'])."VNĐ";?></td>
								<td><?php echo $result_order['quantity'];?></td>
								<td><?php echo $fm->formatDate($result_order['order_date']);?></td>
								<td>
									<?php
									if($result_order['status']==0)
									{
										echo 'Pending';
									}
									elseif($result_order['status']==1){
									?>
									<span>Shifted</span>
									<?php
								     }elseif($result_order['status']==2){
								     ?>
								     <span>Received</span>
								     	<?php
								     }
								     	?>
									</td>
								</td>
								<?php
								if($result_order['status']==0){
								?>
								<td><?php echo 'N/A'?></td>
								<?php
							     }elseif($result_order['status']==1){
								?>
								<td><a href="?confirmid=<?php echo $result_order['customerId']?>&price=<?php echo $result_order['price']?>&order_date=<?php echo $result_order['order_date']?>">Confirmed</a></td>
								<?php
							    }elseif($result_order['status']==2){
							    ?>
							    <td><?php echo "Received";?></td>
							    <?php
							    } 
							    ?>
								<td>
								</td>
							</tr>
							<?php
						}
							?>
							<?php
						
						
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