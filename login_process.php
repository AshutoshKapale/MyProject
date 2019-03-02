<?php
include('inc/mysql_connection.php');
session_start();
 $un = addslashes($_REQUEST["username"]);
 $user = stripslashes($un);
 $username = mysql_real_escape_string($user);
 $pw = addslashes($_REQUEST["password"]);
 $pwd = stripslashes($pw);
 $password = mysql_real_escape_string($pwd);

    $sql_check_login = "SELECT `user_id`,  `username`, `user_type` FROM  user WHERE BINARY username = '" . $username . "' AND BINARY password = '" . $password . "' AND status='1' ";
	$res = mysql_query($sql_check_login);
	if ($res==false)
		{
			die(mysql_error());
		}
	$result = mysql_fetch_array($res);
	$num_of_rows = mysql_num_rows($res); 

if ($num_of_rows != "") {
     $user_id = $result['user_id'];
    //$user_type = $result['user_id'];
    $user_nm = $result['username']; 
	/*Select CSP details from  tbl_bcmaster */
	$select_csp_details = "select Cspname from tbl_bcmaster where Cspcode = '".$user."'";
	$result_csp_details = mysql_query($select_csp_details);
	if ($result_csp_details==false)
		{
			die(mysql_error());
		}
	$result_csp_name = mysql_fetch_array($result_csp_details);
    $result_csp_name1 = $result_csp_name['Cspname']; 
    //$csp_name = $result['csp_name']; 
	
	
     $user_data_for_csp = $user_id . '-' . $user_nm.'-'.$result_csp_name1;
     $user_data_for_bc = $user_id . '-' . $user_nm;
	 
	    /*
        //$expire = time() + 180;
          //setcookie("KioskBanking", $user_data_for_csp, $expire);
		*/
            
    if ($result['user_type']==2) {
	
	        /*
				set session for csp
			*/
			
		    $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 3 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
		   // session_register("user_data1");
	        $_SESSION['user_data1']=$user_data_for_csp;
		  
	      
          header("Location: admin/admin_home.php");
	  
    } 
	else if($result['user_type']==1) {
		 // session_register("user_data");
	      $_SESSION['user_data']=$user_data_for_bc;  	
	  header("Location: bc/admin_home.php");  
	}
	else {

    header("Location: index.php?msg=err");
    
	
}
   
} else {

    header("Location: index.php?msg=err");
    
	
}
?>