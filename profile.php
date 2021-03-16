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
<style type="text/css">
	.order_page{
		font-size: 30px;
		font-weight: bold;
		color: red;
	}
</style>
<div class="main">
<div class="content">
	<div class="section group">
		<div class="content_top">
    		<div class="heading">
    		<h3>profile customer</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
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
</div>	
<?php
include 'inc/footer.php';
?>

