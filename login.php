<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
      {
      	$insertCustomer=$customer->insert_customer($_POST);
      }
?>
<?php
   $login_check=session::get('customer_login');
   if($login_check)
   {
   	header('location:order.php');
   }
?>
<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']))
      {
      	$loginCustomer=$customer->login_customer($_POST);
      }
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<?php
        	if(isset($loginCustomer)){
        		echo $loginCustomer;
        	}
        	?>
        	<form action="" method="POST" id="member">
                	<input  type="text" name="email" class="field" placeholder="email">
                    <input  type="password" name="password" class="field" placeholder="passoword">
              
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><input type="submit" name="login" class="grey" value="Sing In"></div></div>
             </form>
           </div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php
    		if(isset($insertCustomer)){
    			echo $insertCustomer;
    		}
    		?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zipCode" placeholder="Zip code">
							</div>
							<div>
								<input type="text" name="email" placeholder="E-Mail">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
					<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="VN">Việt Nam</option>
							<option value="HK">Hoa Kì</option>
							<option value="NB">Nhật Bản</option>
		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Telephone">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" value="Create Account" class="grey"></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
include 'inc/footer.php';
?>

