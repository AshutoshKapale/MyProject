<?php
include('inc/mysql_connection.php');
error_reporting(0);
$bc_code = $_REQUEST['bc_code'];
$date_of_birth = $_REQUEST['temptime']; 

$new_dob = explode('/',$date_of_birth);
$new_date_of_birth = $new_dob[2].'-'.$new_dob[1].'-'.$new_dob[0]; 

//$select_bc_code = "select * from  tbl_bcmaster where Cspcode = '".$bc_code."' AND date_of_birth = '".$new_date_of_birth."' AND status=1";
 $select_bc_code = "select * from  tbl_bcmaster where Cspcode = '".$bc_code."' AND date_of_birth = '".$new_date_of_birth."'"; 
$res_bc_code = mysql_query($select_bc_code); 


if ($res_bc_code==false)
		{
			die(mysql_error());
		}
		
		$count_in_tbl_bcmaster = mysql_num_rows($res_bc_code);
		$result_bc_code = mysql_fetch_array($res_bc_code);
		$cspCode = $result_bc_code['Cspcode'];
		if($count_in_tbl_bcmaster >0)
		  {
		  $check_bc_code_in_user = "select * from user where username = '".$cspCode."' ";
		  $res_check_bc_code_in_user = mysql_query($check_bc_code_in_user);
		  if ($res_check_bc_code_in_user==false)
			{
				die(mysql_error());
			}
		
		$count_in_user = mysql_num_rows($res_check_bc_code_in_user);
		if($count_in_user >0)
		{
		  header("Location:enter_bc_code.php?msg=user_already_exist");
		}
		else{
		  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
<script type="text/javascript"> 
    function checkForm(form)
		{ 
		//alert("dzfasad"); 
		if(form.bc_code.value == "") 
		{
		alert("Error: BC Code cannot be blank!"); 
		form.bc_code.focus(); return false; 
		}

		re = /^\w+$/; 
		if(!re.test(form.bc_code.value)) 
		{ 
		alert("Error: BC Code must contain only letters, numbers!"); 
		form.bc_code.focus(); return false; } 
		if(form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) 
		{
		if(form.pwd1.value.length < 6) 
		{
			alert("Error: Password must contain at least six characters!"); 
		form.pwd1.focus(); return false; }
		if(form.pwd1.value == form.bc_code.value) 
			{ 
				alert("Error: Password must be different from BC Code!"); 
				form.pwd1.focus(); return false; } re = /[0-9]/; 
			if(!re.test(form.pwd1.value))
				{ 
					alert("Error: password must contain at least one number (0-9)!");
				form.pwd1.focus(); 
				return false; 
				}
		re = /[a-z]/; 
		if(!re.test(form.pwd1.value)) 
			{
				alert("Error: password must contain at least one lowercase letter (a-z)!"); 
				form.pwd1.focus(); 
				return false;
			} 
		re = /[A-Z]/; 
		if(!re.test(form.pwd1.value))
			{ 
				alert("Error: password must contain at least one uppercase letter (A-Z)!"); 
				form.pwd1.focus(); return false; 
			} 
		} else { 
			alert("Error: Please check that you've entered and confirmed your password!"); 
			form.pwd1.focus(); 
			return false;
		} //alert("You entered a valid password: " + form.pwd1.value); 
		if(form.csp_name.value == "") 
		  {
			alert("Error: CSP Name cannot be blank!"); 
			  form.bc_code.focus(); return false; 
		   }
		   return true; 
		 }
 </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" type="img/ico" href="images/favicon.ico">
<title>Working Capital Enhancement Change Password</title>
<link href="css/style.css"  rel="stylesheet" type="text/css"/>
</head>
<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0"  bgcolor="#000000" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" >
				<tr>
					<td>
						<?php include('inc/header1.php'); ?>
					</td>
				</tr>
			   <tr>
							<td  height="530" valign="top">
								<table width="100%" border="0" cellspacing="0" cellpadding="0" >
									<tr>
										<td  height="25" valign="top">
										<div class="header_left_back"></div>
											<div class="header_middle_back1">&nbsp;
											  <a href="index.php"><img src="images/my_home.png" align="absmiddle"></a>&nbsp;
												<span class="heading_text" >Working Capital Enhancement Create Password</span></div>
											  <div class="header_right_back"></div>
											  </td>
									</tr>
									<tr>
										<td  valign="bottom" align="center" class="font_red_b" >
								  <div style="float: none; margin-top: 74px; width: 100%;">
									<?php 
																		
									   if ($_GET['msg'] == "error") {
											echo "Please Enter Valid Details!";
										}
										else if ($_GET['msg'] == "error_in_inr") {
											echo "Technical Error!";
										}
										else if ($_GET['msg'] == "success") {
											echo "Kiosk Registration Successful!";
										}
									?>
								  </div>
								</td>
							</tr>
							<tr>
								<td  valign="top">
								 <table width="93%" border="0" cellspacing="3" cellpadding="3"  align="center" />
								   <tr>
									 <td>
								   <fieldset id="fieldset3" class="fieldset">
									<legend class="form_legend_heading_maroon">Create Password</legend>
									<table width="50%" border="0" cellspacing="3" cellpadding="3"  align="center" class="data" >
									<form id="myForm" method="POST" action="kiosk_registration_process.php" onsubmit="return checkForm(this);">
										<tr>
											<td width="30%" class="form_heading_text" align="right">BC Code</td>
											<td width="30%" align="left" class="form_text">
											   <input type="text" name="bc_code" value="<?=$cspCode?>" id="bc_code" maxlength="8" readonly />
											</td>
										  </tr>
											<tr>
												<td class="form_heading_text" align="right">New Password</td>
												<td class="form_text"><input type="password" name="pwd1" value="" id="pwd1" /></td>
											</tr>
											<tr>
												<td class="form_heading_text" align="right">Confirm Password</td>
												<td class="form_text"><input type="password" name="pwd2"  value="" id="pwd2" /></td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td><input type="submit" name="Update" value="Submit" class="submit" />
												</td>
											</tr>
											<tr>
											   <td></td>
											   <td><span id="msg" class="error_msg_m"></span></td>
											</tr>
										</form>
										
									</table>
                                   </fieldset>
								   </td>
							     </tr>
						        </table>
							</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<?php include_once('inc/footer1.php'); ?>
					</td>
				</tr>
			</table>


		</td>
	</tr>
	
</table>
</body>
</html>
<?php
 }
}
else{
     header("Location:enter_bc_code.php?msg=no_entry");
}
?>