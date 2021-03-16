<?php
  $filepath=realpath(dirname(__FILE__));
  require_once ($filepath.'/../lib/database.php');
  require_once ($filepath.'/../helper/format.php');
?>
<?php
/**
 * 
 */
class product
{ 
     private $db;
     private $fm;	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function search_product($tukhoa){
		$tukhoa=$this->fm->validation($tukhoa);
		$query="SELECT * FROM tbl_product where productName like '%$tukhoa%'";
		$result=$this->db->select($query);
		return $result;
	}
	public function insert_product($data,$files)
	{
		$productName= mysqli_real_escape_string($this->db->link,$data['productName']);
		$brand= mysqli_real_escape_string($this->db->link,$data['brand']);
		$category= mysqli_real_escape_string($this->db->link,$data['category']);
		$product_desc=mysqli_real_escape_string($this->db->link,$data['product_desc']);
		$type= mysqli_real_escape_string($this->db->link,$data['type']);
		$price= mysqli_real_escape_string($this->db->link,$data['price']);

		$primited = array('jpg','png','gif' );
		
		$file_name=$_FILES['image']['name'];
		$file_size=$_FILES['image']['size'];
		$file_tmp=$_FILES['image']['tmp_name'];
		$div=explode('.',$file_name);
		$file_ext=strtolower(end($div));
		$unique_image=substr(md5(time()),0,10).'.'.$file_ext;
		$upload_image="upload/".$unique_image;

	  if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $type=="" || $price=="" || $file_name=="")
	  {
	  $alert="<span class='error'>Bạn phải điền đầy đủ thông tin</span>";
	  return $alert;
	  }
	  else
	  {
	  	move_uploaded_file($file_tmp,$upload_image);

	  	$query="INSERT INTO tbl_product(productName,catId,brandId,product_desc,price,image,type) values('$productName','$category','$brand','$product_desc','$price','$unique_image','$type')";

	  	$result=$this->db->insert($query);
	  	if($result)
	  	{
	  		$alert = "<span class='success'>Thêm sản phẩm thành công</span>";
	  		return $alert;
	  	}
	  	else
	  	{
	  	  $alert="<span class='error'>Thêm sản phẩm thất bại</span>";
	  	  return $alert;
	  	}
	  
	  }

	}
	 public function show_product() 
	{
		$query="SELECT tbl_product.* ,tbl_category.catName,tbl_brand.brandName 

		from tbl_product 
		inner join tbl_category 
		on tbl_product.catId = tbl_category.catId 
		inner join tbl_brand on tbl_product.brandId = tbl_brand.brandId
		 order by tbl_product.productId desc";
		$result=$this->db->select($query);
		return $result;
	}
	public function getproductbyId($id)
	{
		$query="SELECT * from tbl_product  where productId= '$id' order by productId desc";
		$result=$this->db->select($query);
		return $result;

	}
	public function updateProduct($data,$files,$id)
	{
		$productName= mysqli_real_escape_string($this->db->link,$data['productName']);
		$brand= mysqli_real_escape_string($this->db->link,$data['brand']);
		$category= mysqli_real_escape_string($this->db->link,$data['category']);
		$product_desc=mysqli_real_escape_string($this->db->link,$data['product_desc']);
		$type= mysqli_real_escape_string($this->db->link,$data['type']);
		$price= mysqli_real_escape_string($this->db->link,$data['price']);

		$primited = array('jpg','png','gif' );
		
		$file_name=$_FILES['image']['name'];
		$file_size=$_FILES['image']['size'];
		$file_tmp=$_FILES['image']['tmp_name'];
		$div=explode('.',$file_name);
		$file_ext=strtolower(end($div));
		$unique_image=substr(md5(time()),0,10).'.'.$file_ext;
		$upload_image="upload/".$unique_image;

	  if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $type=="" || $price=="")
	  {
	  $alert="Không được để trống";
	  return $alert;
	  }
	  else
	  {
	  	if(!empty($file_name))
	  	{
	  		if($file_size>204800)
	  		{
	  			$alert= "<span class='error'>file không dưới 20MB</span>";
	  			return $alert;
	  		}
	  		elseif(in_array($file_ext,$primited)==false)
	  		{
	  			$alert= "<span class='error'>bạn có thể uploaf fle".implode(',',$primited)."</span>";
	  			return $alert;
	  		}
	  		move_uploaded_file($file_tmp,$upload_image);
	  		$query="
	  		UPDATE tbl_product set 
	  		productName='$productName',
	  		catId='$category',
	  		brandId='$brand',
	  		product_desc='$product_desc',
	  		price='$price',
	  		image='$unique_image',
	  		type='$type'
	  		where productId='$id'";
	  	    $result=$this->db->update($query);
	  	}
	  	else
	  		//người dùng không chon ảnh
	  	{
	  		$query="
	  		UPDATE tbl_product set 
	  		productName='$productName',
	  		catId='$category',
	  		brandId='$brand',
	  		product_desc='$product_desc',
	  		price='$price',
	  		type='$type'
	  		where productId='$id'";
	  	    $result=$this->db->update($query);
	  	}
	  	if($result)
	  	{
	  		$alert = "<span class='success'>Cập nhật thành công</span>";
	  		return $alert;
	  	}
	  	else
	  	{
	  	  $alert="<span class='error'>Cập nhật thất bại</span>";
	  	  return $alert;
	  	}
	  
	  }
	}
	public function del_product($id)
	{
		$query="DELETE from tbl_product where productId='$id'";
		$result=$this->db->delete($query);
		if($result)
		{
			$alert = "<span class='success'>Xóa thành công</span>";
	  		return $alert;
		}
		else
		{
			$alert = "<span class='success'>Xóa thất bại</span>";
			return $alert;

		}
	}
	public function insert_Slider($data,$files)
	{
		$sliderName= mysqli_real_escape_string($this->db->link,$data['sliderName']);
		$type      = mysqli_real_escape_string($this->db->link,$data['type']);

		$primited = array('jpg','png','gif' );
		
		$file_name=$_FILES['image']['name'];
		$file_size=$_FILES['image']['size'];
		$file_tmp=$_FILES['image']['tmp_name'];
		$div=explode('.',$file_name);
		$file_ext=strtolower(end($div));
		$unique_image=substr(md5(time()),0,10).'.'.$file_ext;
		$upload_image="upload/".$unique_image;

	  if($sliderName=="" || $type=="" || $file_name=="")
	  {
	  $alert="<span class='error'>Bạn phải điền đầy đủ thông tin</span>";
	  return $alert;
	  }
	  else
	  {
	  	move_uploaded_file($file_tmp,$upload_image);

	  	$query="INSERT INTO tbl_slider(sliderName,sliderImages,type) values('$sliderName','$unique_image','$type')";

	  	$result=$this->db->insert($query);
	  	if($result)
	  	{
	  		$alert = "<span class='success'>Thêm slider thành công</span>";
	  		return $alert;
	  	}
	  	else
	  	{
	  	  $alert="<span class='error'>Thêm slider thất bại</span>";
	  	  return $alert;
	  	}
	  
	  }
	}
	public function show_slider_admin(){
		$query="SELECT * from tbl_slider";
		$result=$this->db->select($query);
		return $result;
	}
	public function update_slider($id,$type){
		$type=mysqli_real_escape_string($this->db->link,$type);
		$id=mysqli_real_escape_string($this->db->link,$id);
		$query="UPDATE tbl_slider SET type='$type' WHERE sliderId='$id'";
		$result=$this->db->update($query);
	}
	//xuat sp ra index.
	public function show_slider_index(){
		$query="SELECT * from tbl_slider where type='1' order by sliderId desc limit 5";
		$result=$this->db->select($query);
		return $result;
	}
	public function del_slider($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
		$query="DELETE FROM tbl_slider WHERE sliderId='$id'";
		$result=$this->db->delete($query);
		if($result){
			$alert="<span class='success'>XOa thanh cong</span>";
			return $alert;
		}
		else
		{
			$alert="<span class='error'>Xoa that bai</span>";
			return $alert;
		}
	}
	public function show_product_feture(){
		$query="SELECT * from tbl_product  where type= '1' order by productId desc limit 4";
		$result=$this->db->select($query);
		return $result;
	}
	public function show_product_new(){
		if(!isset($_GET['trang'])){
			$trang=1;
		}
		else
		{
			$trang=$_GET['trang'];
		}
		$sotrang_mot=8;
		$sotrang_tiep=($trang-1)*$sotrang_mot;
		$query="SELECT * from tbl_product order by productId desc limit $sotrang_tiep,$sotrang_mot";
		$result=$this->db->select($query);
		return $result;
	}
	public function show_product_all(){
		$query="SELECT * FROM tbl_product";
		$result=$this->db->select($query);
		return $result;
	}
	public function show_product_detail($id){
		$query="SELECT tbl_product.* ,tbl_category.catName,tbl_brand.brandName 
		from tbl_product 
		inner join tbl_category 
		on tbl_product.catId = tbl_category.catId 
		inner join tbl_brand on tbl_product.brandId = tbl_brand.brandId
		where tbl_product.productId='$id' 
		 order by tbl_product.productId desc";
		$result=$this->db->select($query);
		return $result;
	}
	public function show_top_app(){
		$query_app="SELECT * from tbl_product where brandId='1' order by productId desc limit 1 ";
		$result_app=$this->db->select($query_app);
		return $result_app;
	}
	public function show_top_dell(){
		$query_dell="SELECT * from tbl_product where brandId='4' order by productId desc limit 1 ";
		$result_dell=$this->db->select($query_dell);
		return $result_dell;
	}
	public function show_top_sony(){
		$query_sony="SELECT * from tbl_product where brandId='3' order by productId desc limit 1 ";
		$result_sony=$this->db->select($query_sony);
		return $result_sony;
	}

	public function show_top_ss(){
		$query_ss="SELECT * from tbl_product where brandId='2' order by productId desc limit 1 ";
		$result_ss=$this->db->select($query_ss);
		return $result_ss;
	}
	public function insert_compare($customer_id,$productid){
		$customer_id=mysqli_real_escape_string($this->db->link,$customer_id);
		$productid=mysqli_real_escape_string($this->db->link,$productid);
		$check_compare="SELECT * FROM tbl_compare where customer_id='$customer_id' and product_id='$productid'";
		$result_checkCompare=$this->db->select($check_compare);
		if($result_checkCompare){
			$alert="<span class='error'>san pham da them vao truoc do</span>";
			return $alert;
		}
		else
		{
			$query_product="SELECT * FROM tbl_product where productId='$productid'";
			$result_product=$this->db->select($query_product)->fetch_assoc();
			$productName=$result_product['productName'];
			$price=$result_product['price'];
			$image=$result_product['image'];
			$query_insertCompare="INSERT INTO tbl_compare(customer_id,product_id,product_name,price,image) values('$customer_id','$productid','$productName','$price','$image')";
			$result_insertCompare=$this->db->insert($query_insertCompare);
			if($result_insertCompare){
				$alert="<span class='success'>them thanh cong</span>";
				return $alert;
			}
			else
			{
				$alert="<span class='error'>them that bai</span>";
				return $alert;
			}
		}
	}
	public function show_compare($customerid){
		$query_compare="SELECT * from tbl_compare where customer_id='$customerid' order by id desc";
		$result_compare=$this->db->select($query_compare);
		return $result_compare;
	}
	public function insert_wishlist($customer_id,$productid){
		$customer_id=mysqli_real_escape_string($this->db->link,$customer_id);
		$productid=mysqli_real_escape_string($this->db->link,$productid);
		$check_wishlist="SELECT * FROM tbl_wishlist where customer_id='$customer_id' and product_id='$productid'";
		$result_checkWishlist=$this->db->select($check_wishlist);
		if($result_checkWishlist){
			$alert="<span class='error'>san pham da them vao truoc do</span>";
			return $alert;
		}
		else
		{
			$query_product="SELECT * FROM tbl_product where productId='$productid'";
			$result_product=$this->db->select($query_product)->fetch_assoc();
			$productName=$result_product['productName'];
			$price=$result_product['price'];
			$image=$result_product['image'];
			$query_insertWishlist="INSERT INTO tbl_wishlist(customer_id,product_id,product_name,price,images) values('$customer_id','$productid','$productName','$price','$image')";
			$result_insertWishlist=$this->db->insert($query_insertWishlist);
			if($result_insertWishlist){
				$alert="<span class='success'>them thanh cong</span>";
				return $alert;
			}
			else
			{
				$alert="<span class='error'>them that bai</span>";
				return $alert;
			}
		}
	}
	public function show_wishlist($customerid){
		$query_wishlist="SELECT * from tbl_wishlist where customer_id='$customerid' order by id desc";
		$result_wishlist=$this->db->select($query_wishlist);
		return $result_wishlist;
	}
	public function del_Wishlist($customer_id,$proid){
		$customer_id=mysqli_real_escape_string($this->db->link,$customer_id);
		$proid=mysqli_real_escape_string($this->db->link,$proid);
		$query_delWishlist="DELETE FROM tbl_wishlist WHERE customer_id='$customer_id' AND product_id='$proid'";
		$result_delWishlist=$this->db->delete($query_delWishlist);
	}
}

?>