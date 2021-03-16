<?php
  $filepath=realpath(dirname(__FILE__));
  require_once ($filepath.'/../lib/database.php');
  require_once ($filepath.'/../helper/format.php');
?>
<?php
/**
 * 
 */
class brand
{ 
     private $db;
     private $fm;	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function insert_brand($brandName)
	{
		$brandName =$this->fm->validation($brandName);

		$brandName= mysqli_real_escape_string($this->db->link,$brandName);

	  if(empty($brandName))
	  {
	  $alert="Không được để trống";
	  return $alert;
	  }
	  else
	  {
	  	$query="INSERT into tbl_brand(brandName) values('$brandName')";
	  	$result=$this->db->insert($query);
	  	if($result)
	  	{
	  		$alert = "<span class='success'>Thêm thành công</span>";
	  		return $alert;
	  	}
	  	else
	  	{
	  	  $alert="<span class='error'>Thêm thất bại</span>";
	  	  return $alert;
	  	}
	  
	  }

	}
	public function show_brand()
	{
		$query="SELECT * from tbl_brand order by brandId desc";
		$result=$this->db->select($query);
		return $result;
	}
	public function brandId($id)
	{
		$query="SELECT * from tbl_brand  where brandId= '$id' order by brandId desc";
		$result=$this->db->select($query);
		return $result;

	}
	public function updateBrand($brandName,$id)
	{
		$brandName =$this->fm->validation($brandName);

		$brandName= mysqli_real_escape_string($this->db->link,$brandName);
		$id= mysqli_real_escape_string($this->db->link,$id);

	  if(empty($brandName))
	  {
	  $alert="Không được để trống";
	  return $alert;
	  }
	  else
	  {
	  	$query="UPDATE tbl_brand set brandName='$brandName' where brandId='$id'";
	  	$result=$this->db->update($query);
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
	public function del_brand($id)
	{
		$query="DELETE from tbl_brand where brandId='$id'";
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
}

?>