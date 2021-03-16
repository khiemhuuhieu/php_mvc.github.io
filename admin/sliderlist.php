<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php'?>
<?php require_once '../helper/format.php' ?>
<?php
$product=new product();
if(isset($_GET['slider_id']) && isset($_GET['type'])){
	$id=$_GET['slider_id'];
	$type=$_GET['type'];
	$update_slider=$product->update_slider($id,$type);
}
if(isset($_GET['del_slider'])){
	$id=$_GET['del_slider'];
	$del_slider=$product->del_slider($id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$show_slider=$product->show_slider_admin();
				if($show_slider){
					$i=0;
					while($result=$show_slider->fetch_assoc()){
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['sliderName'];?></td>
					<td><img src="upload/<?php echo $result['sliderImages']?>" height="120px" width="300px"/></td>				
					<td>
						<?php
						if($result['type']==1){
						?>
						<a href="?slider_id=<?php echo $result['sliderId']?>&type=0">ON</a>
						<?php
					   }else{
						?>
						<a href="?slider_id=<?php echo $result['sliderId']?>&type=1">OFF</a>
						<?php
					}
						?>
					</td>
					<td>
					<a onclick="return confirm('Are you sure to Delete!');" href="?del_slider=<?php echo $result['sliderId']?>" >Delete</a> 
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
