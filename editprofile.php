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
if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['save']))

{
    $id=session::get('customer_id');
    $updateCustomer=$customer->update_customers($_POST,$id);
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
    		<h3>Profile customer</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
        <form action="" method="POST">
    	<table class="tblone">
            <tr>
               <td colspan="3">
                   <?php
                   if(isset($updateCustomer)){
                    echo $updateCustomer;                   
                } 
                   ?>
               </td> 
            </tr>
          <?php
    		$id=session::get('customer_id');
    		$show_customers=$customer->show_customer($id);
    		if($show_customers){
    			while($result_cus=$show_customers->fetch_assoc()){
    		?>
    		<tr>
    			<td>Name</td>
    			<td>:</td>
               <td><input type="text" name="name" value="<?php echo $result_cus['name']?>"></td>
    		</tr>
    		<tr>
    			<td>Zip code</td>
    			<td>:</td>
    			<td><input type="text" name="zipcode" value="<?php echo $result_cus['zipcode'];?>"></td>
    		</tr>
    		<tr>
    			<td>Phone</td>
    			<td>:</td>
    			<td><input type="text" name="phone" value="<?php echo $result_cus['phone'];?>"></td>
    		</tr>
    		<tr>
    			<td>Email</td>
    			<td>:</td>
    			<td><input type="text" name="email" value="<?php echo $result_cus['email'];?>"></td>
    		</tr>
    		<tr>
    			<td colspan="3"><input type="submit" name="save" value="save"></th>
    		</tr>
    		<?php
    	}
    }
    		?>
    	</table>
    </form>
</div>
</div>
</div>	
<?php
include 'inc/footer.php';
?>


