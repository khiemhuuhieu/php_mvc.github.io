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
 <div class="main">
    <div class="content">
    	<div class="section group">
    			<div class="heading">
    				<?php
    				$customer_id=session::get('customer_id');
    				$show_totalPrice=$cart->getAmountPrrice($customer_id);
    				if($show_totalPrice){
    					$while_total=0;
    					while ($result_totalPrice=$show_totalPrice->fetch_assoc()) {
    						$price=$result_totalPrice['price'];
    						$while_total+=$price;
    					}
    				}
    				?>
    		<h3>success</h3>
    		<p>Tong tien ban da mua trong lan dat hang nay
    			<?php
    			$vat=$while_total*0.1;
    			echo $fm->format_currency($gtotal=$while_total+$vat).' '."VND";
    		    ?></p>
    		<p>Chung toi se lien he som voi ban. Vui long keim tra gio hang <a href="orderdetails.php">Click here</a></p>
    		</div>
    		<div class="clear"></div>
 		</div>
 	</div>
 </div>
<?php
include 'inc/footer.php';
?>>

