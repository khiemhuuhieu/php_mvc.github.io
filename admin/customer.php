<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
  $filepath=realpath(dirname(__FILE__));
   require_once ($filepath.'/../classes/customer.php');
?>
<?php
if(isset($_GET['customerid']) && $_GET['customerid']==NULL)
{
  $id=$_GET['customerid'];
}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thông tin khách hàng</h2>
               <div class="block copyblock">
                <span>
               
                <?php
                $customer=new customer();
                $id=$_GET['customerid'];
                $get_customer=$customer->show_customer($id);
                if($get_customer)
                {
                  while($result =$get_customer->fetch_assoc())
                  {
               
                ?>
                </span> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                        <th>Name</th>
                        <th>:</th>
                        <th><input type="text" name="name" readonly="readonly" value="<?php echo $result['name']?>"></th>    
                        </tr>
                        <tr>
                        <th>Address</th>
                        <th>:</th>
                        <th><input type="text" name="address" readonly="readonly" value="<?php echo $result['address']?>"></th>    
                        </tr>
                        <tr>
                        <th>City</th>
                        <th>:</th>
                        <th><input type="text" name="city" readonly="readonly" value="<?php echo $result['city']?>"></th>    
                        </tr>
                        <tr>
                        <th>Country</th>
                        <th>:</th>
                        <th><input type="text" name="country" readonly="readonly" value="<?php echo $result['country']?>"></th>    
                        </tr>
                        <tr>
                        <th>Zip code</th>
                        <th>:</th>
                        <th><input type="text" name="zipcode" readonly="readonly" value="<?php echo $result['zipcode']?>"></th>    
                        </tr>
                        <tr>
                        <th>Phone</th>
                        <th>:</th>
                        <th><input type="text" name="phone" readonly="readonly" value="<?php echo $result['phone']?>"></th>    
                        </tr>
                        <tr>
                        <th>Email</th>
                        <th>:</th>
                        <th><input type="text" name="email" readonly="readonly" value="<?php echo $result['email']?>"></th>    
                        </tr>
						            
                    </table>
                    </form>
                    <?php
                  }
                }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>