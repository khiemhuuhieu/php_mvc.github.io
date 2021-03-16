<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'?>
<?php include '../classes/product.php'?>
<?php include '../classes/brand.php'?>

<?php
$pd= new product();

 if(isset($_GET['productid']) && $_GET['productid']==NULL)
{
  echo "<script>window.location='productlist.php' </script>";
}
else
{
  $id=$_GET['productid'];
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
{
  $productName=$_POST['productName'];
  $updateProduct=$pd->updateProduct($_POST,$_FILES,$id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block"> 
        <?php
        if(isset($updateProduct)){
            echo $updateProduct;
        }
        ?>  

        <?php
        $get_product_id=$pd->getproductbyid($id);
        if($get_product_id){
            while ($result_pr=$get_product_id->fetch_assoc()) {
                
        ?> 
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result_pr['productName']?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                         <option>-------Select Category------</option>
                        <?php
                        $cate=new category();
                        $catelist=$cate->show_category();
                        if($catelist)
                        {
                            while($result=$catelist->fetch_assoc()){
                        ?>
                        <option
                        <?php
                        if($result['catId']==$result_pr['catId'])
                        {
                          echo "selected";
                        }
                        ?> 
                        value="<?php echo $result['catId']?>"><?php echo $result['catName'];?></option>
                        <?php
                    }
                        } 
                        ?> 
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                        <option>-------Select Brand------</option>
                        <?php
                        $brand=new brand();
                        $brandlist=$brand->show_brand();
                        if($brandlist)
                        {
                            while($result=$brandlist->fetch_assoc()){
                        ?>
                        <option
                        <?php
                        if($result['brandId']==$result_pr['brandId'])
                        {
                            echo "selected";
                        }
                        ?> 
                        value="<?php echo $result['brandId']?>"><?php echo $result['brandName'];?></option>
                        <?php
                    }
                        } 
                        ?>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="product_desc"><?php echo $result_pr['product_desc'];?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result_pr['price']?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="upload/<?php echo $result_pr['image']?>" width="70px"><br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                            if($result_pr['type']==0)
                            {
                            ?>
                            <option value="1">Featured</option>
                            <option selected value="0">Non-Featured</option>
                           <?php
                           }else{
                           ?>
                           <option selected value="1">Featured</option>
                           <option value="0">Non-Featured</option>
                           <?php
                       }
                           ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


