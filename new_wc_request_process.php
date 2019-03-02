<?php
    if (isset($_COOKIE["KioskBanking"])) {
    $tmp = explode('-', $_COOKIE["KioskBanking"]);
    
} else {
    header("Location: ../index.php");
    exit();
}
	error_reporting(0);	
 // echo  $csp_name = $tmp['2']; 
    $user_id = $tmp['0'];
    $bccode = $tmp['1']; 
	include('../inc/mysql_connection.php');
	
	
	 // $user_id = $tmp['0'];	  
	
	 $bc_code = $_REQUEST['bc_code']; 
	
	 $six_digit_random_number = mt_rand(100000, 999999);
	   $request_id = "ZERO".$six_digit_random_number; 
	 
	 $deposit_br_code = $_REQUEST['deposit_br_code'];  
	 $length = strlen($deposit_br_code);
     
	  $last_validity_date = $_REQUEST['temptime'];   
	
	 if($last_validity_date=='')
	 {
		$last_validity_date=date("d/m/Y"); 
	 }
	 
	 $new_date = explode('/', $last_validity_date);
	  $new_date1 = $new_date[2].'-'.$new_date[1].'-'.$new_date[0];  
	 
	 $current_date = date("Y-m-d"); 
	 $description = $_REQUEST['description'];
	
	 
	 if($length==3)
		{
		 $new_branch = "00".$deposit_br_code; 
		 
		}
		else if($length==4)
		{
		 $new_branch = "0".$deposit_br_code;
		 
		}
		else{
			$new_branch =$deposit_br_code; 
		}
		
	    $new_branch1 = $new_branch; 
	    $new_branch2 = strlen($new_branch1);  
	    $amount = $_REQUEST['amount'];  
	    $amount1 = strlen($amount);

	 if(!empty($bc_code)){
	 
	 
	 
	 
	 //check for valid bc code
	 $select_bc_code_from_tbl_bcmaster = "select * from tbl_bcmaster where Cspcode = '".$bc_code."' AND Status ='1' "; 
	 $res_bc_code_from_tbl_bcmaster = mysql_query($select_bc_code_from_tbl_bcmaster);  
	 $result_bc_code_from_tbl_bcmaster =mysql_fetch_array($res_bc_code_from_tbl_bcmaster);
	// $user_id = $result_bc_code_from_user['user_id'];
     $num_of_record_for_cspcode = mysql_num_rows($res_bc_code_from_tbl_bcmaster); 
     if($num_of_record_for_cspcode>0)	
     {
	  
	  
	  
	 if($new_branch2<3 || $new_branch1=='' || $new_branch1==0 || $new_branch1==00 || $new_branch1==000 || $new_branch1==0000 || $new_branch1==000000 && $amount1<1 || $amount==0 || $description=='' || $last_validity_date==''){
	    header("Location:new_wc_request.php?msg=value_blank");
	 }
	 else{
	  //$days_ago = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 3, date("Y"))); 
       // echo $new_date1; echo "<br/>";
	
    if ($new_date1 <= $current_date)
	 {   
	 
	    $select_request_details = "select * from wc_request_status where amount = '".$amount."' AND request_date = '".$new_date1."' and user_id = '".$user_id ."' ";
		$res_request_details = mysql_query($select_request_details); 
	   $num_of_rows = mysql_num_rows($res_request_details); 
		 
		
		if($num_of_rows == 0){
		
		//select staus from wc_status
	 
				   
	         $insert_request_details = "insert into wc_request_status(branch_code, request_date, amount, status, request_id, user_id, csp_code, description, Type, file_id) 
										Values('".$new_branch1."', '".$new_date1."', '".$amount."', 1, '".$request_id."', '".$user_id."', '".$bc_code."', '".$description."', 'D', '0')";
			 $result_request_details = mysql_query($insert_request_details);
             if ($result_request_details==false)
			{
				die(mysql_error());
			}			 
			 if($result_request_details)
			 {
				?>
			
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" type="img/ico" href="../images/favicon.ico">
        <title>Kiosk Banking Home</title>
        <link href="../css/style.css"  rel="stylesheet" type="text/css" />
    </head>
<body>
<table width="1024" border="0" cellspacing="0" cellpadding="0"  bgcolor="#000000" align="center">
	<tr>
		<td>
			<table width="1000" border="0" cellspacing="0" cellpadding="0" bgcolor="#ececca" align="center">
				<tr>
					<td>
						<?php include('../inc/header.php'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff"  >
							<tr>
								<td align="left"  valign="top">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" >
										<tr>
											<!-- side panel  start-->
											<td width="15%"  valign="top"><?php include('side_panel.php'); ?></td>
											<!-- side panel end-->
											<!-- right container start-->
											<td valign="top" width="100%">
												<table width="50%" border="0" cellspacing="0" cellpadding="0" >
													<tr>
														<td  height="25" valign="top">
														<div class="header_left_back"></div>
															<div class="header_middle_back">&nbsp;
															  <img src="../images/my_home.png" align="absmiddle">&nbsp;
																<span class="heading_text" >Welcome&nbsp;<?php echo $csp_name." (".$bccode.") "; ?></span></div>
															  <div class="header_right_back"></div>
															  
															  </td>
													</tr>
													
													<tr>
														<td align="center">
														 <div class="container_middle_slice" >
														  <!--content start here -->
														  <table width="100%" border="0" cellspacing="2" cellpadding="2"  style="padding-top:100px;">
															 <tr>
															   <td>
																 <!--form content start -->
																   <table width="70%" border="0" cellspacing="3" cellpadding="3"   >
																		<form id="myForm" method="POST" action="#" onsubmit="return formValidator();">
																			<tr>
																					
																				<td class="form_text">
																				<div class="font_blue_xl">Request id generated......, please use this request ID (<b><?=$request_id?></b>) to check the working capital status.</div>
																				</td>
																			</tr>
																			
																			</form>
																		</table>
																 
																 <!--form content end -->
																
																</td>
															   
															</tr>
														</table>
														<!--content end here -->
												 
<br />                                                </div>
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
									<?php 
									   include_once('../inc/footer.php');
									?>
								</td>
							 </tr>
						</table>
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
			  
			
			 header("Location:new_wc_request.php?msg=same_amt_date_error");
		}
	 }
	 else{
	    header("Location:new_wc_request.php?msg=date_error");
	 }
	 
	 } 
	}
     else{
	      header("Location:new_wc_request.php?msg=bc_code_not_available");
	 }	 
	 
	 
	 }
	 else{
	      header("Location:new_wc_request.php?msg=bc_code_empty");
	 }
	
 
 ?>