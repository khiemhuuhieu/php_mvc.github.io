<?php
  $filepath=realpath(dirname(__FILE__));
  require_once ($filepath.'/../lib/database.php');
  require_once ($filepath.'/../helper/format.php');
?>
<?php
/**
 * 
 */
class cart
{ 
     private $db;
     private $fm;	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function add_to_cart($quantity,$id){

		$quantity=$this->fm->validation($quantity);
		$quantity= mysqli_real_escape_string($this->db->link,$quantity);
		$id= mysqli_real_escape_string($this->db->link,$id);
		$sId=session_id();

		$query="SELECT * FROM tbl_product where productId = '$id'";
		$result=$this->db->select($query)->fetch_assoc();

		$productName=$result['productName'];
		$price=$result['price'];
		$image=$result['image'];

		$check_cart="SELECT * FROM tbl_cart where productId='$id' AND sId='$sId'";
		$checkcart=$this->db->select($check_cart);

		if($checkcart){
			$alert="Sản phẩm đã có trong giỏ hàng";
			return $alert;
		}
		else
		{
		$query_insert="INSERT INTO tbl_cart(productId,sId,productName,price,quantity,image) values('$id','$sId',
		'$productName','$price','$quantity','$image')";
		$result_insert=$this->db->insert($query_insert);
		    if($result_insert)
		    {
			    header('location:cart.php');
		    }
	        else
	        {
	    	    header('location:404.php');
	        }
	     }
	}
	public function show_product_cart(){

		$sid=session_id();
		$query="SELECT * FROM tbl_cart where sId='$sid'";
		$result_cart=$this->db->select($query);
		return $result_cart;
	}
	public function update_cart($quantity,$cartId){
		$quantity=$_POST['quantity'];
		$cartId=$_POST['cartId'];

		$query="UPDATE tbl_cart SET quantity='$quantity' where cartId='$cartId'";
		$result_update=$this->db->update($query);

		if($result_update)
		{
			header('location:cart.php');
		}
		else
		{
			$alert="Cập nhật số lượng thất bại";
			return $alert;
		}
	}
	public function delCart($cartid){
		$cartid= mysqli_real_escape_string($this->db->link,$cartid);

		$query_delCart="DELETE FROM tbl_cart where cartId='$cartid'";
		$result_del=$this->db->delete($query_delCart);

		if($result_del)
		{
			header('location:cart.php');
		}
		else
		{	
			$alert="<span class='error'>Xoa that bai</span>";
		}
	}
	public function check_session_cart(){
		$sId=session_id();

		$query="SELECT * FROM tbl_cart where sId='$sId'";
		$result=$this->db->select($query);
		return $result;
	}
	public function check_session_order($customer_id){
		$sId=session_id();

		$query="SELECT * FROM tbl_order where customerId='$customer_id'";
		$result=$this->db->select($query);
		return $result;
	}
	public function del_all_cart(){
		$sId=session_id();

		$query="DELETE FROM tbl_cart where sId='$sId'";
		$result=$this->db->select($query);
		return $result;
	}
	public function dell_all_compare($customerid){
		$customerid=mysqli_real_escape_string($this->db->link,$customerid);
		$sid=session_id();
		$query="DELETE FROM tbl_compare WHERE customer_id='$customerid'";
		$result=$this->db->delete($query);
		return $result;
	}
	public function insertOrder($customer_id){
		$sid=session_id();

		$query="SELECT * FROM tbl_cart where sId='$sid'";
		$get_order=$this->db->select($query);
		if($get_order){
			while ($result=$get_order->fetch_assoc()) {
				
			$productId=$result['productId'];
			$productName=$result['productName'];
			$customerId=$customer_id;
			$quantity=$result['quantity'];
			$price=$result['price']* $quantity;
			$image=$result['image'];

			$query_insertOrder="INSERT INTO tbl_order(productId,productName,customerId,quantity,price,image) values('$productId','$productName','$customerId','$quantity','$price','$image')";
			$result=$this->db->insert($query_insertOrder);
			}
	      }  
    }
    public function getAmountPrrice($customer_id){
        	$query="SELECT price FROM tbl_order where customerId='$customer_id'";
        	$result_total=$this->db->select($query);
        	return $result_total; 	

    }
    public function show_order($customer_id){
        	$query="SELECT * FROM tbl_order where customerId='$customer_id'";
        	$result=$this->db->select($query);
        	return $result;
    }
    public function get_inboxCart(){
        	$query="SELECT * FROM tbl_order order by order_date";
        	$result=$this->db->select($query);
        	return $result;
    }
    public function shifted($id,$price,$order_date){
    	$id= mysqli_real_escape_string($this->db->link,$id);
    	$price= mysqli_real_escape_string($this->db->link,$price);
    	$order_date= mysqli_real_escape_string($this->db->link,$order_date);

    	$query_updateStatus="UPDATE tbl_order SET status='1' WHERE id='$id' and order_date='$order_date'";
    	$result_updateStatus=$this->db->update($query_updateStatus);
    	if($result_updateStatus){
    		$alert="<span class='success'>Thanh cong</span>";
    		return $alert;
    	}
    	else
    	{
    		$alert="<span class='error'>That bai</span>";
    		return $alert;
    	}
    }
    public function del_shifted($id,$price,$order_date){
        $id= mysqli_real_escape_string($this->db->link,$id);
    	$price= mysqli_real_escape_string($this->db->link,$price);
    	$order_date= mysqli_real_escape_string($this->db->link,$order_date);  	
    	$query_delShifted="DELETE from tbl_order where id='$id' and price='$price' and order_date='$order_date'";
    	$result_delShifted=$this->db->delete($query_delShifted);
    	if($result_delShifted){
    		$alert="<span class='success'>Thanh cong</span>";
    	}
    }
    public function confirm_shifted($id,$price,$order_date){
    	$id= mysqli_real_escape_string($this->db->link,$id);
    	$price= mysqli_real_escape_string($this->db->link,$price);
    	$order_date= mysqli_real_escape_string($this->db->link,$order_date);

    	$query_confirmStatus="UPDATE tbl_order SET status='2' WHERE customerId='$id' and order_date='$order_date' and price='$price'";
    	$result_confirmStatus=$this->db->update($query_confirmStatus);
    }
}
?>