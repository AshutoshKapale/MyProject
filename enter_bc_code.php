<?php
include('inc/mysql_connection.php');
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	 <link href="sample-css/page.css" rel="stylesheet" type="text/css" />
    <link href="css/dp.css" rel="stylesheet" type="text/css" />
    
    
    <script src="src/jquery.js" type="text/javascript"></script>
    <script src="src/Plugins/datepicker_lang_US.js" type="text/javascript"></script>
    <script src="src/Plugins/jquery.datepicker.js" type="text/javascript"></script>
	<script type="text/javascript">
        $(document).ready(function() {           
           
            $("#temptime").datepicker({ picker: "<img class='picker' align='middle' src='sample-css/cal.gif' alt=''/>" });
            $("#hdobj").datepicker({ 
                picker: "#handler",  //this should be a hidden
                onReturn:function(d){
                    alert(d.Format("d/M, yyyy"));
                    $("#target").html(d.Format("d/M, yyyy"));
                } 
            });
            function rule(id) {
                if (id == 'datetime') {
                    var v = $("#endtime").val();
                    if (v == "") {
                        return null;
                    }
                    else {
                        var d = v.match(/^(\d{1,4})(-|\/|.)(\d{1,2})\2(\d{1,2})$/);
                        if (d != null) {
                            var nd = new Date(parseInt(d[1], 10), parseInt(d[3], 10) - 1, parseInt(d[4], 10));
                            return { enddate: nd };
                        }
                        else {
                            return null;
                        }
                    }
                }
                else {
                    var v = $("#datetime").val();
                    if (v == "") {
                        return null;
                    }
                    else {
                        var d = v.match(/^(\d{1,4})(-|\/|.)(\d{1,2})\2(\d{1,2})$/);
                        if (d != null) {
                            var nd = new Date(parseInt(d[1], 10), parseInt(d[3], 10) - 1, parseInt(d[4], 10));
                            return { startdate: nd };
                        }
                        else {
                            return null;
                        }
                    }

                }
            }
        });
    </script>
	<script type="text/javascript">
		function formValidator()
		 {
			// Make quick references to our fields
			 
			 var bc_code = document.getElementById('bc_code');
			 var temptime = document.getElementById('temptime');
			 
			 if(notEmpty(bc_code, "Please Enter BC Code")){
			  if(isAlphanumeric(bc_code, "BC Code Should be in Alpha Numeric Format")){
				if(notEmpty(temptime, "Please Select Date of Birth")){
				      return true;
						}
					}
		    	}
			 return false;
		 }
		function notEmpty(elem, helperMsg){
			if(elem.value.length ==0){
				alert(helperMsg);
				//document.getElementById("msg").innerHTML=helperMsg;
				elem.focus(); // set the focus to this input
				return false;
			}
			return true;
		 }

		function isNumeric(elem, helperMsg){
			var numericExpression = /^[0-9.]+$/;
			if(elem.value.match(numericExpression)){
				return true;
			}
			else{
				alert(helperMsg);
				//document.getElementById("msg").innerHTML=helperMsg;
				elem.focus();
				return false;
			}
		}
		function isNumeric1(elem, helperMsg){
			var numericExpression = /^[0-9]+$/;
			if(elem.value.match(numericExpression)){
				return true;
			}
			else{
				alert(helperMsg);
				//document.getElementById("msg").innerHTML=helperMsg;
				elem.focus();
				return false;
			}
		}
		function isAlphanumeric(elem, helperMsg){
			var alphaExp = /^[0-9a-zA-Z]+$/;
			if(elem.value.match(alphaExp)){
				return true;
			}else{
				alert(helperMsg);
			//document.getElementById("msg").innerHTML=helperMsg;
				elem.focus();
				return false;
			}
		}
			
	</script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" type="img/ico" href="images/favicon.ico">
        <title>Working Capital Enhancement BC Code Verification</title>
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
													  <a href="index.php"></div>
													  <div class="header_right_back"></div>
													  </td>
											</tr>
                                            <tr>
                                                <td  valign="bottom" align="center" class="font_red_b" >
                                          <div style="float: none; margin-top: 74px; width: 100%;">
											<?php 
																				
											   if ($_GET['msg'] == "no_entry") {
													echo "BC Code or Date of Birth Not Available, Please contact KIOSK HELP DESK for further Details!";
												}
												else if ($_GET['msg'] == "user_already_exist") {
													echo "User Already Registered !";
												}
												else if ($_GET['msg'] == "success") {
													echo "Kiosk Registration Successful !";
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
											<legend class="form_legend_heading_maroon">Enter BC Code</legend>
                                            <table width="50%" border="0" cellspacing="3" cellpadding="3"  align="center"  class="data" />
											<form id="myForm" method="POST" action="kiosk_registration.php" onsubmit="return formValidator();">
											   <tr>
												   <td></td>
												   <td>
													<span id="msg" class="error_msg_m"></span>
												   </td>
												</tr>
                                                <tr>
													<td width="30%" class="form_heading_text" align="right">Enter BC Code</td>
													<td width="43%" align="left" class="form_text">
													   <input type="text" name="bc_code" value="" id="bc_code" maxlength="8" />
													</td>
												  </tr>
												  <tr>
														<td class="form_heading_text" align="right">Enter Date of Birth</td>
														<td class="form_text">
															<input type="text" id="temptime" value="" name="temptime" readonly />
														</td>
												  </tr>
												  <tr>
													<td>&nbsp;</td>
													<td>
													   <input type="submit" name="submit" value="Next" class="submit" />
													</td>
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
