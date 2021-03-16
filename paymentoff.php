<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
<?php
   $login_check=session::get('customer_login');
   if($login_check==false)
   {
   	header('location:login.php');
   }
?>
<?php
if(isset($_GET['orderid']) && $_GET['orderid']=='order')
{
  $customer_id=session::get('customer_id');
  $insertOrder=$cart->insertOrder($customer_id);
  $delCart=$cart->del_all_cart();
  header('location:success.php');
}
?>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
    		<h3>Offline payment </h3>
    		</div>
    		<div class="clear"></div>
    		<div class="box_left">
    			<div class="cartpage">
			 
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
								<th width="5%">ID</th>
								<th width="25%">Product Name</th>
								<th width="25%">Price</th>
								<th width="10%">Quantity</th>
								<th width="25%">Total Price</th>
							</tr>
							<?php
							$show_cart=$cart->show_product_cart();
							if($show_cart){
								$i=0;
								$subtotal=0;
								$qty=0;
								while($result_cart=$show_cart->fetch_assoc()){
									$i++;
							?>
							<tr>
								<td><?php echo $i?></td>
								<td><?php echo $result_cart['productName'];?></td>
								<td><?php echo $fm->format_currency($result_cart['price']).' '."VNĐ";?></td>
								<td><?php echo $result_cart['quantity'];?></td></td>
								<td>
									<?php
									$total=$result_cart['price']*$result_cart['quantity'];
									echo $fm->format_currency($total).' '."VNĐ";
									?>
								</td>
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
						<table style="float:right;text-align:left;margin: 5px;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>
									<?php
									echo $fm->format_currency($subtotal).' '."VNĐ";
									session::set('qty',$qty);
									session::set('sum',$subtotal);
									?>
								</td>
							</tr>
							<tr>
								<th>VAT </th>
								<td>
									10% (<?php echo $fm->format_currency($vat=$subtotal*0.10);?>)
								</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php
									$gtotal=$subtotal+$vat;
									echo $fm->format_currency($gtotal).' '."VNĐ";
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
    		</div>
    		<div class="box_right">
    			<table class="tblone">
    		<?php
    		$id=session::get('customer_id');
    		$show_customers=$customer->show_customer($id);
    		if($show_customers){
    			while($result_cus=$show_customers->fetch_assoc()){
    		?>
    		<tr>
    			<td>Name</td>
    			<td>:</td>
    			<td><?php echo $result_cus['name'];?></td>
    		</tr>
    		<tr>
    			<td>Address</td>
    			<td>:</td>
    			<td><?php echo $result_cus['address'];?></td>
    		</tr>
    		<tr>
    			<td>City</td>
    			<td>:</td>
    			<td><?php echo $result_cus['city'];?></td>
    		</tr>
    		<tr>
    			<td>Country</td>
    			<td>:</td>
    			<td><?php echo $result_cus['country'];?></td>
    		</tr>
    		<tr>
    			<td>Zip code</td>
    			<td>:</td>
    			<td><?php echo $result_cus['zipcode'];?></td>
    		</tr>
    		<tr>
    			<td>Phone</td>
    			<td>:</td>
    			<td><?php echo $result_cus['phone'];?></td>
    		</tr>
    		<tr>
    			<td>Email</td>
    			<td>:</td>
    			<td><?php echo $result_cus['email'];?></td>
    		</tr>
    		<tr>
    			<td colspan="3"><a href="editprofile.php">update profile</a></th>
    		</tr>
    		<?php
    	}
    }
    		?>
    	</table>
    		</div>
 		</div>
 		</div><br>
 		<center><a href="?orderid=order" class="submit_order" class="margin_order">Order Now</a></center><br><br>
 	</div>
	</form>
<?php
include 'inc/footer.php';
?>>

