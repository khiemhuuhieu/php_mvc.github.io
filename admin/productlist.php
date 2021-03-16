<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/category.php'?>
<?php include '../classes/product.php'?>
<?php include '../classes/brand.php'?>
<?php require_once '../helper/format.php' ?>
<?php
$pd=new product();
if(isset($_GET['delId']))
{
	 $id=$_GET['delId'];
	 $delProduct=$pd->del_product($id);	

}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">  
        	<?php
        	if(isset($delProduct))
        	{
        		echo $delProduct;
        	}
        	?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Product Price</th>
					<th>Product Image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$product=new product();
				$fm=new Format();
				$productlist=$product->show_product();
				if($productlist){
					$i=0;
					while ($result=$productlist->fetch_assoc()) {
						$i++;
						
				?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $fm->format_currency($result['price'])."VNĐ"?></td>
					<td><img src="upload/<?php echo $result['image']?>" width="50px"></td>
					<td><?php echo $result['catName']?></td>
					<td><?php echo $result['brandName']?></td>
					<td><?php
					if($result['type']==0)
					{
					  echo "Non-Featured";
					}
					else
					{
					  echo "Featured";
					}
					?>
			        </td>
					<td><a href="productedit.php?productid=<?php echo $result['productId']?>">Edit</a> || <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm')" href="?delId=<?php echo $result['productId']?>">Delete</a></td>
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
