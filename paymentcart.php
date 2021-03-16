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
	echo "<meta http-equiv='refresh' co ntent='0;URL=?id=live'>";
}
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    		<div class="heading">
    		<h3> Payment method</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    	     <div class="fj">
    	     	<span>Chooses your method payment</span><br>
    		<a href="paymentoff.php" class="off">Offine payment</a>
    		<a href="paymenton.php" class="on">Online payment</a><br>
    		<a href="cart.php">>>Previous</a>
    		</div>
    	</div>
       <div class="clear"></div>
    </div>
 </div>

<?php
include 'inc/footer.php';
?>