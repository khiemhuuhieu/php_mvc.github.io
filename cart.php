<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
<?php
if(isset($_GET['cartId']))
{
	$cartid=$_GET['cartId'];
	$delCart=$cart->delCart($cartid);
}
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['submit'])) {
	$quantity=$_POST['quantity'];
	$cartId=$_POST['cartId'];
	$update_quantity_cart=$cart->update_cart($quantity,$cartId);
	if($quantity<=0){
		$delCart=$cart->delCart($cartId);
	}
}
?>
<?php
if(!isset($_GET['id']))
{
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php
			    	if(isset($update_quantity_cart)){
			    		echo $update_quantity_cart;
			    	}
			    	?>
			    	<?php
			    	if(isset($delCart)){
			    		echo $delCart;
			    	}
			    	?>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							$show_cart=$cart->show_product_cart();
							if($show_cart){
								$subtotal=0;
								$qty=0;
								while($result_cart=$show_cart->fetch_assoc()){
							?>
							<tr>
								<td><?php echo $result_cart['productName'];?></td>
								<td><img src="admin/upload/<?php echo $result_cart['image']?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result_cart['price'])."VNĐ";?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" min="0" value="<?php echo $result_cart['cartId']?>"/>
									<input type="number" name="quantity" min="0" value="<?php echo $result_cart['quantity']?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>
									<?php
									$total=$result_cart['price']*$result_cart['quantity'];
									echo $fm->format_currency($total)."VNĐ";
									?>
								</td>
								<td><a onclick="return confirm('ban co chac muon xoa khong')" href="?cartId=<?php echo $result_cart['cartId']?>">Xoa</a></td>
							</tr>
							<?php
							$subtotal+=$total;
							$qty+=$result_cart['quantity'];
						}
					}
							?>

							
						</table>
						<?php
						$check_session_cart=$cart->check_session_cart();
						if($check_session_cart){

						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>
									<?php
									echo $fm->format_currency($subtotal)."VNĐ";
									session::set('qty',$qty);
									session::set('sum',$subtotal);
									?>
								</td>
							</tr>
							<tr>
								<th>VAT : 10%</th>
								<td>
									<?php
									$vat=$subtotal*0.1;
									
									?>
								</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php
									$gtotal=$subtotal+$vat;
									echo $fm->format_currency($gtotal)."VNĐ";
									?>
								</td>
							</tr>
					   </table>
					   <?php
					}else
					{
						echo "gio hang rong";
					}
					   ?>
		
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="paymentcart.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php
include 'inc/footer.php';
?>