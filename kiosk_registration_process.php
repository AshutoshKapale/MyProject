<?php
include('inc/mysql_connection.php');
error_reporting(0);
$bc_code = $_REQUEST['bc_code'];
$pwd1 = $_REQUEST['pwd1'];
$pwd2 = $_REQUEST['pwd2'];
//$csp_name = $_REQUEST['csp_name'];

if($bc_code =='' || $pwd1 != $pwd2)
{
 header("Location:index.php?msg=error");
 
}
else{
     
		$select_username = "select * from user where username ='".$bc_code."' ";
		$res_username = mysql_query($select_username);
		//$result_username = mysql_fetch_array($res_username);
		$num_of_rows = mysql_num_rows($res_username);
	 if($num_of_rows ==0)
	   {
	
			 $insert_into_user_details = "INSERT INTO  user(username, creation_date, password, user_type, status) 
											VALUES('" . $bc_code . "', NOW(), '" . $pwd1 . "', 2, '1')";
			$insert_details               = mysql_query($insert_into_user_details);
			if($insert_details){?>
			
			   <script>
        			   alert("WC Create Password Successful, Please login with your Username and Password!");
					   window.location.href = "index.php";
                       
                 </script>
				 <?php
			  //header("Location:index.php?msg=success");
			  //echo '<script> alert("success") </script>';
			 // echo '<script language="JavaScript"> window.location.href ="login.html" </script>';
			}
			else{
			 header("Location:index.php?msg=error_in_inr");
			}
		}
		else{
		     header("Location:index.php?msg=bc_code_already");
		   
		}
	 
}

//check username

/*
function addKioskDetails($bc_code, $pwd1, $csp_name)
{
     
  echo   $insert_into_activity_details = "INSERT INTO  user(username, creation_date, password, csp_name) 
                                    VALUES('" . $bc_code . "', NOW(), '" . $pwd1 . "', '".$csp_name."')";
    $insert_details               = mysql_query($insert_into_activity_details);
    
}
*/
?>