<?php
  $filepath=realpath(dirname(__FILE__));
  require_once ($filepath.'/../lib/database.php');
  require_once ($filepath.'/../helper/format.php');
?>
<?php
/**
 * 
 */
class customer
{ 
     private $db;
     private $fm;	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function insert_commnet(){
		$product_id=$_POST['product_id_binhluan'];
		$tenbinhluan=$_POST['tennguoibinhluan'];
		$binhluan=$_POST['binhluan'];
		if($tenbinhluan=='' || $binhluan==''){
			$alert="<span class='error'>Bạn điền đầy đủ thông tin</span>";
			return $alert;
		}
		else
		{
			$query_insertComment="INSERT INTO tbl_comment(tenbinhluan,binhluan,product_id) VALUES('$tenbinhluan','$binhluan','$product_id')";
			$result_insertComment=$this->db->insert($query_insertComment);
			if($result_insertComment){
				$alert="<span class='success'>Admin sẽ sớm trả lời bạn</span>";
				return $alert;
			}
			else
			{
				$alert="<span class='error'>Bình luận thất bại</span>";
				return $alert;
			}
		}
	}
	public function insert_customer($data)
	{
		$cus_name= mysqli_real_escape_string($this->db->link,$data['name']);
		$cus_city= mysqli_real_escape_string($this->db->link,$data['city']);
		$cus_zipCode= mysqli_real_escape_string($this->db->link,$data['zipCode']);
		$cus_email= mysqli_real_escape_string($this->db->link,$data['email']);
		$cus_address= mysqli_real_escape_string($this->db->link,$data['address']);
		$cus_country= mysqli_real_escape_string($this->db->link,$data['country']);
		$cus_phone= mysqli_real_escape_string($this->db->link,$data['phone']);
		$cus_password= mysqli_real_escape_string($this->db->link,md5($data['password']));

		if($cus_name=="" || $cus_city=="" || $cus_zipCode=="" || $cus_email=="" || $cus_address=="" || $cus_country=="" || $cus_phone=="" || $cus_password==""){

			$alert="<span style='color:red'>Bạn phải điền đầy đủ thông tin</span>";
			return $alert;

		}
		else
		{
			$check_email="select * from tbl_customer where email='$cus_email' limit 1";
			$result_email=$this->db->select($check_email);
			if($result_email){
				$alert="<span style='color:red'>Email đã tồn tại</span>";
				return $alert;
			}	
			else
			{
				$query="insert into tbl_customer(name,address,city,country,zipCode,phone,email,password) values('$cus_name','$cus_address','$cus_city','$cus_country','$cus_zipCode','$cus_phone','$cus_email','$cus_password')";
				$result=$this->db->insert($query);
				if($result)
				{
					$alert="<span style='color:red'>Đăng kí thành công</span>";
					return $alert;
				}
				else
				{
					$alert="<span style='color:red'>Đăng kí thất bại</span>";
					return $alert;
				}
			}		
		}
	}
	public function login_customer($data){
		$cus_email= mysqli_real_escape_string($this->db->link,$data['email']);
		$cus_password= mysqli_real_escape_string($this->db->link,md5($data['password']));
		if($cus_email=='' || $cus_password=='')
		{
			$alert="<span style='color:red'>Bạn phải nhập đầy đủ</span>";
			return $alert;
		}
		else
		{
			$check_login="select * from tbl_customer where email='$cus_email' and password='$cus_password' limit 1";
			$result_checkLogin=$this->db->select($check_login);
			if($result_checkLogin){
				$value=$result_checkLogin->fetch_assoc();
				session::set('customer_login',true);
				session::set('customer_id',$value['id']);
				session::set('customer_name',$value['name']);
				header('location:order.php');
			}
			else
			{
				$alert="<span style='color:red'>Bạn nhập sai mật khẩu hoặc email</span>";
				return $alert;
			}

		}
	}
	public function show_customer($id){
		$query="select * from tbl_customer where id='$id'";
		$result=$this->db->select($query);
		return $result;
	}
	public function update_customers($data,$id){
		$cus_name= mysqli_real_escape_string($this->db->link,$data['name']);
		$cus_zipCode= mysqli_real_escape_string($this->db->link,$data['zipcode']);
		$cus_email= mysqli_real_escape_string($this->db->link,$data['email']);
		$cus_phone= mysqli_real_escape_string($this->db->link,$data['phone']);
		if($cus_name=="" ||  $cus_zipCode=="" || $cus_email=="" || $cus_phone=="" ){

			$alert="<span style='color:red'>Bạn phải điền đầy đủ thông tin</span>";
			return $alert;

		}
		else
		{
			$query_updateCus="update tbl_customer set name='$cus_name',zipcode='$cus_zipCode',phone='$cus_phone' , email='$cus_email'";
			$result_update=$this->db->insert($query_updateCus);
			if($result_update){
				$alert="<span style='color:blue'>Cập nhật thành công</span>";
				return $alert;
			}	
			else
			{
				$alert="<span style='color:red'>Cập nhật thất bại</span>";
				return $alert;
			}		
		}

	}
}
?>