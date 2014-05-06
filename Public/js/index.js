$(document).ready(function(){
	$('#btn_refuse').click(function (){
		$('#user').val('');
		$('#pwd').val('');
		$('#myModal').modal('hide')
	});
	
	$('#btn_accept').click(function (){

		if ( $('#suser').size()>0 ){
			var user = $('#suser');
			var pwd = $('#spwd');
		} else {
			var user = $('#user');
			var pwd = $('#pwd');
		}
		
		var btn = $('#btn_accept');
        btn.button('loading');
		$('#btn_refuse').attr("disabled",true);
        setTimeout(function () {
          btn.button('reset')
        }, 8000);
		
		$.post(SignURL,{user : user.val(), pwd : pwd.val()},function (data){
			$('#myModal').modal('hide');
			switch(data.status) {
			case 0:
				$('#user').val('');
				$('#pwd').val('');
				alert("用户名或密码错误.");break;
			case 1:
				location.reload(true);break;
			case 2:
				$('#myModal').modal('hide');
				alert("获取您的信息失败,请稍后再试.");
			};
		},'json');
	});
});

function Loginin(){
		var user = $('#suser');
		var pwd = $('#spwd');
		if (user.val() === ''){
			user.focus();
			return false;
		}
		if (pwd.val() === ''){
			pwd.focus();
			return false;
		}
		
		$.post(LoginURL,{user : user.val(), pwd : pwd.val()},function (data){
			switch(data.status) {
			case 0:
				terror.innerHTML="用户名或密码错误.";break;
			case 1:
				document.location=SignURL.substring(0, SignURL.lastIndexOf('Login'));
			case 2:
				$('#myModal').modal({
					backdrop:true,
					keyboard:true,
					show:true
				}); 
				$('#myModal').toggle();
			};
		},'json');
		return false;
}

function LoginSubmit() {
		var user = $('#user');
		var pwd = $('#pwd');
		if (user.val() === ''){
			user.focus();
			return false;
		}
		if (pwd.val() === ''){
			pwd.focus();
			return false;
		}
		
		$.post(LoginURL,{user : user.val(), pwd : pwd.val()},function (data){
			switch(data.status) {
			case 0:
				alert("用户名或密码错误.");break;
			case 1:
				location.reload(true);break;
			case 2:
				$('#myModal').modal({
					backdrop:true,
					keyboard:true,
					show:true
				}); 
				$('#myModal').toggle();
			};
		},'json');

		return false;
}