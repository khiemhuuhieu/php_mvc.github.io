<?php
  $filepath=realpath(dirname(__FILE__));
  include ($filepath.'/../lib/session.php');
  Session::checkLogin();
  include_once ($filepath.'/../lib/database.php');
  include_once ($filepath.'/../helper/format.php');
?>
<?php
/**
 * 
 */
class adminLogin
{ 
     private $db;
     private $fm;	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function login_admin($adminUser,$adminPass)
	{
		$adminUser =$this->fm->validation($adminUser);
		$adminPass =$this->fm->validation($adminPass);

		$adminUser= mysqli_real_escape_string($this->db->link,$adminUser);
		$adminPass= mysqli_real_escape_string($this->db->link,$adminPass);

	  if(empty($adminUser) || empty($adminPass))
	  {
	  $alert="Không được để trống các trường";
	  return $alert;
	  }
	  else
	  {
	  	$query="SELECT * from tbl_admin where adminUser='$adminUser' and adminPass='$adminPass' limit 1";
	  	$result=$this->db->select($query);
	  	if($result != false)
	  	{
	  	    $value = $result->fetch_assoc();
	  	    session::set('adminLogin' , true);
	  	    session::set('adminId'    , $value['adminId']);
	  	    session::set('adminName'  , $value['adminName']);
	  	    session::set('adminUser'  , $value['adminUser']);

	  	    header('location:index.php');
	  	}
	  	else
	  	{
	  	  $alert="Tài khoản hoặc mật khẩu bạn nhập không đúng";
	  	  return $alert;
	  	}
	  
	  }



	}
}
?>