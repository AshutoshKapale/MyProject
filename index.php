<?php
include('inc/mysql_connection.php');
error_reporting(0);

$select_alerts ="select * from alerts order by alert_id desc limit 1";
$result_alerts = mysql_query($select_alerts);
$res_alerts = mysql_fetch_array($result_alerts);

$alerts = $res_alerts['description'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" type="img/ico" href="images/favicon.ico">
        <title>Working Capital Enhancement Login</title>
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
													<div class="header_middle_back1"></div>
													  <div class="header_right_back"></div>
													  </td>
											</tr>
											<tr>
												<td colspan="2" align="center" class="font_red_xl">
													<marquee><?="$alerts"?></marquee>
													
												</td>
											</tr>	
                                            <tr>
                                                <td  valign="bottom" align="center" class="font_red_b" >
                                                    <div style="float: none; margin-top: 74px; width: 100%;">
											<?php //success12
																				
											   if ($_GET['msg'] == "err") {
													echo "Invalid Username or Password!";
												}else if ($_GET['msg'] == "error") {
													echo "Please Enter Valid Details!";
												}
												else if ($_GET['msg'] == "error_in_inr") {
													echo "Technical Error!";
												}
												else if ($_GET['msg'] == "success") {
												    
													echo "Kiosk Registration Successful!";
												} 
												else if ($_GET['msg'] == "bc_code_already") {
													echo "BC Code Already Registred!";
												}
												else if ($_GET['msg'] == "error_in_Updation") {
													echo "Error in Update User Details!";
												}
												else if ($_GET['msg'] == "success12") {
												 ?>
												 <script>
        			  alert("Change Password Successful, Please login with your Username and New Password!");
					  
                       
                 </script>
												 <?php
												}
											?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  valign="top">
                                            <table width="50%" border="0" cellspacing="0" cellpadding="0"  align="center" class="loginbox"  bgcolor="#fefede">
                                                <tr>
                                                    <td width="119"  align="center" valign="middle" class="heading_text">Login</td>
                                                </tr>
                                                <form action="login_process.php" method="post" name="form">
                                                    <tr>
                                                        <td width="216" valign="top" class="login_text"><input type="text" name="username"  size="34" style="padding-top:6px; padding-bottom:6px; color:#666;font-family:Arial;"  onblur="if(this.value==''){this.value='Enter UserName'}" onfocus="if(this.value=='Enter UserName'){this.value=''}" value="Enter UserName"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top" class="login_text"><input type="password" name="password" class="form-login" size="34" style="padding-top:6px; padding-bottom:6px; color:#666; font-family:Arial;" onblur="if(this.value==''){this.value='Enter Password'}" onfocus="if(this.value=='Enter Password'){this.value=''}" value="Enter Password" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top" align="right" style="padding-right: 36px; padding-top:20px;">
														  <input type="image" name="submit" src="images/login.png" width="50" height="18" value="Login" style="color:#000;" />
														</td>
                                                    </tr>
												</form>
												
                                            </table>

                                        </td>
                                    </tr>
									<tr>
									   <td>
									    <table width="50%" border="0" cellspacing="0" cellpadding="0"  align="center">
											<tr>
                                                <td valign="top" align="center" >
												 <a href="enter_bc_code.php">New User</a> &nbsp;&nbsp;/&nbsp;&nbsp;<a href="forgot_password.php">Forgot your password?</a>
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