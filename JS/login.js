// JavaScript Document
    
function checklogin(){
		  var el_username = document.getElementById('username');
		  var el_password = document.getElementById('password');
		  var el_code = document.getElementById('code');
		  var el_tip_username = document.getElementById('tip_username');
		  var el_tip_password = document.getElementById('tip_password');
		  var el_tip_code = document.getElementById('tip_code');
		  var meg = ['请输入账号！', '请输入密码！', '请输入验证码！'];
		  if (el_username.value == ''){
			  el_tip_username.textContent = meg[0];
			  el_username.style.border = "1px solid red";
			  return false;
		  }else if (el_password.value == ''){
			  el_tip_password.textContent =meg[1];
			  el_password.style.border = "1px solid red";
			  return false;
		  }else if (el_code.value == ''){
			  el_tip_code.textContent = meg[2];
			  el_code.style.border = "1px solid red";
			  return false;
		  }
	  }