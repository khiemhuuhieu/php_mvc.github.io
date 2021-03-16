<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../helper/format.php'?>
<?php
  $filepath=realpath(dirname(__FILE__));
  require_once ($filepath.'/../classes/cart.php');
?>
<?php
$cart=new cart();
if(isset($_GET['shiftid']))
{
	$id=$_GET['shiftid'];
	$price=$_GET['price'];
	$order_date=$_GET['order_date'];
	$update_shifted=$cart->shifted($id,$price,$order_date);
}
?>
<?php
if(isset($_GET['delid'])){
	$id=$_GET['delid'];
	$price=$_GET['price'];
	$order_date=$_GET['order_date'];
	$del_shifted=$cart->del_shifted($id,$price,$order_date);
}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block"> 
                <?php
                if(isset($update_shifted)){
                	echo $update_shifted;
                }
                ?>
                <?php
                if(isset($del_shifted)){
                	echo $del_shifted;
                }
                ?>
           
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Order time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>CustomerID</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$cart=new cart();
						$fm=new Format();
						$get_inboxCart=$cart->get_inboxCart();
						if($get_inboxCart){
							$i=0;
							while($result_inboxCart=$get_inboxCart->fetch_assoc()){
								$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result_inboxCart['order_date']);?></td>
							<td><?php echo $result_inboxCart['productName'];?></td>
							<td><?php echo $result_inboxCart['quantity'];?></td>
							<td><?php echo $result_inboxCart['price'].' '."VND";?></td>
							<td><?php echo $result_inboxCart['customerId'];?></td>
							<td><a href="customer.php?customerid=<?php echo $result_inboxCart['customerId']?>">view customer</a></td>
							<td>
								<?php
								if($result_inboxCart['status']==0){
								?>
								<a href="?shiftid=<?php echo $result_inboxCart['id']?>&price=<?php echo $result_inboxCart['price']?>&order_date=<?php echo $result_inboxCart['order_date']?>">Pending</a>
								<?php
							    }elseif($result_inboxCart['status']==1){
							    	echo "Shifting..."
								?>
								<?php
						     	}elseif($result_inboxCart['status']==2){
								?>
								<a onclick="return confirm('ban chac muon xoa khong?');" href="?delid=<?php echo $result_inboxCart['id']?>&price=<?php echo $result_inboxCart['price']?>&order_date=<?php echo $result_inboxCart['order_date']?>">remove</a>
								<?php
							}
								?>
							</td>
						</tr>
						<?php
					}
				}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
