$(document).ready(function(){
	UserModel();
	CommunityModel();
});

function Loginin(){
	var user = $('#suser');
	var pwd = $('#spwd');
	var vcode = $('#vcode');
	if (user.val() === ''){
		user.focus();
		return false;
	}
	if (pwd.val() === ''){
		pwd.focus();
		return false;
	}
		
	$.post(LoginURL,{user : user.val(), pwd : pwd.val(),vcode: vcode.val()},function (data){
		switch(data.status) {
		case 0:
			terror.innerHTML="用户名或密码错误.";
			ChangeImg();
			break;
		case -1:
			terror.innerHTML="验证码错误.";
			ChangeImg();
			break;
		case 1:
			document.location=Index;
		}
	},'json');
	return false;
}

function ChangeImg(){
	$('#vcodeimg').attr('src',VCodeURL+'?key='+ new Date().getTime());
	return false;
}

function UserModel(){
	if ($('#add_user').size()>0){
		$('#add_user').click(function(){
			$('#userModal').modal({
					backdrop:true,
					keyboard:true,
					show:true
			}); 
			$('#userModal').modal('show');
		});

		$('#btn_user_add').click(function(){
			$('#btn_user_add').attr("disabled",true);
			$.post(UserAddURL,{ykt:$('#sykt').val() ,xh:$('#sxh').val() ,name:$('#sxm').val() ,pwd:$('#spwd').val() ,power:$('#sqx').val() },function (data){
				switch(data.status) {
				case 0:
					alert("添加失败.");break;
				case 1:
					alert("添加成功.");break;
				case -1:
					alert("用户已存在.");break;
				};
				$('#userModal').modal('hide');
				$('#btn_user_add').attr("disabled",false);
			},'json');
		});
	}
}

function CommunityModel(){
	if ($('#add_community').size()>0){
		$('#add_community').click(function(){
			$('#caddModal').modal({
					backdrop:true,
					keyboard:true,
					show:true
			}); 
			$('#caddModal').modal('show');
		});

		$('#btn_c_add').click(function(){
			$('#btn_c_add').attr("disabled",true);
			$.post(AddURL,{cname:$('#stmc').val() ,ctype:$('#lx').val() ,cpoint:$('#xj').val() ,ccreatetime:$('#cjsj').val()},function (data){
				switch(data.status) {
				case 0:
					alert("添加失败.");break;
				case 1:
					alert("添加成功.");break;
				};
				$('#caddModal').modal('hide');
				$('#btn_c_add').attr("disabled",false);
			},'json');
		});

		$('#btn_c_edit').click(function(){
			$('#btn_c_edit').attr("disabled",true);
			$.post(EditURL,{cid:$('#cid').val(),cname:$('#cname').val() ,ctype:$('#ctype').val() ,cpoint:$('#cpoint').val() ,ccreatetime:$('#ccreatetime').val()},function (data){
				switch(data.status) {
				case 0:
					alert("修改失败.");break;
				case 1:
					alert("修改成功.");break;
				};
				$('#ceditModal').modal('hide');
				$('#btn_c_edit').attr("disabled",false);
			},'json');
		});
	}
}

function DoEdit(cid){
	$('#cid').val(cid);
	$.post(GetURL,{id:cid},function (data){
		d = eval(data);
		$('body').find('input[type=text]').each(function (){
			$(this).val(d[$(this).attr('name')]);
		});
		$('#ceditModal').modal({
			backdrop:true,
			keyboard:true,
			show:true
		}); 
		$('#ceditModal').modal('show');
	},'json');
}