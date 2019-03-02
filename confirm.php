<html>
<body>
<script type="text/javascript"> 
function checkForm(form) 
{ if(form.username.value == "") 
{ alert("Error: Username cannot be blank!"); 
form.username.focus(); return false; }
 re = /^\w+$/; if(!re.test(form.username.value)) 
 { alert("Error: Username must contain only letters, numbers and underscores!"); 
 form.username.focus(); return false; } 
 if(form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) 
 { if(form.pwd1.value.length < 6) { alert("Error: Password must contain at least six characters!"); 
 form.pwd1.focus(); return false; } if(form.pwd1.value == form.username.value) 
 { alert("Error: Password must be different from Username!"); 
 form.pwd1.focus(); return false; } re = /[0-9]/; 
 if(!re.test(form.pwd1.value)) { alert("Error: password must contain at least one number (0-9)!");
 form.pwd1.focus(); return false; } re = /[a-z]/; if(!re.test(form.pwd1.value)) {
 alert("Error: password must contain at least one lowercase letter (a-z)!"); 
 form.pwd1.focus(); return false; } re = /[A-Z]/; if(!re.test(form.pwd1.value)) { 
 alert("Error: password must contain at least one uppercase letter (A-Z)!"); 
 form.pwd1.focus(); return false; } } else { 
 alert("Error: Please check that you've entered and confirmed your password!"); 
 form.pwd1.focus(); return false; } alert("You entered a valid password: " + form.pwd1.value); return true; 
 }
 </script>
 <form onsubmit="return checkForm(this);">
 <p>Username: <input type="text" name="username"></p>
 <p>Password: <input type="password" name="pwd1"></p>
 <p>Confirm Password: <input type="password" name="pwd2"></p>
 <input type="number" name="quantity" min="1" max="5">
 <input type="date" name="bday">
 <input type="range" min="0" max="10" step="2" value="6">
 <p><input type="submit"></p> </form>
</body>
</html>