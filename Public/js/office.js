function Do_Check(){
	if ($('#btn_pass_app').size()>0) return false;

	if ( $('#btn_uploadfile').size()>0 && $('#fname').val() == '') {
		alert("请先上传文件!");
		return false;
	}

	$.post(FormSubmitURL, $("#submitForm").serialize(),function (data){
			DispatchFun_Office(data.type,data.gp,data.status);
		},'json');
	return false;
}

function MsgPicSubmit(){
	$.post(FormSubmitURL, $("#submitForm").serialize(),function (data){
			if (data.status ==1){
				alert("图片说明更新成功.");
			} else {
				alert("图片说明更新失败!请稍后重试.");
			}
		},'json');
	return false;
}

function File_Upload(){
	if ( $('#btn_uploadfile').size()>0 ) {

		$('#btn_uploadfile').click(function(){
			$('#file').click();
		});

		$('#file').live('change',function(){ 
				$('#uploadModal').modal({
					backdrop:true,
					keyboard:true,
					show:true
				});
				var filestr = $('#file').val();
				if ( filestr.lastIndexOf('/') > 0)
					filestr = filestr.substring(0, filestr.lastIndexOf('\\'));
	   		 	$('#uploadModal').modal('show');
				$.ajaxFileUpload({
					url:FormUploadURL,
					secureuri:false,
					fileElementId:'file',
					dataType: 'json',
					success: function (data,status)
					{
						$('#uploadModal').modal('hide');
						if ( typeof(data)=='undefined' ){
							alert('由于第三方插件存在兼容性问题,目前站长仍在努力修复中,请勿使用IE浏览器上传文件.');
							return ;
						}
						switch (data.status){
							case 0:
								alert(data.file);
								break;
							case 1:
								if ( $('#filename').size()>0 ) {
									$('#filename').text(filestr);
									$('#frname').val(filestr);
									$('#fname').val(data.file);
									$('#filename').attr('href',IndexURL.substring(0, IndexURL.lastIndexOf('/'))+'/Public/Upload/File/'+$('#fname').val());
								} else {
									$('#img').attr('src',IndexURL.substring(0, IndexURL.lastIndexOf('/'))+'/Public/Upload/HeadPhoto/pic_'+data.file);
								}
								break;
							default:
								alert("上传失败.");
						}
					},
					error: function (data, status, e)//服务器响应失败处理函数
					{
						$('#uploadModal').modal('hide');
						alert(e);
					}
				});
		});
	}
}

function InLiveChangeFun(fileelement){
	$('#uploadModal').modal({
		backdrop:true,
		keyboard:true,
		show:true
	});
	$('#uploadModal').modal('show');
	tUploadURL = FormUploadURL.substring(0, FormUploadURL.lastIndexOf('/'));
	tUploadURL+='/Photo?id='+fileelement.substring(1, 2);
	$.ajaxFileUpload({
		url:tUploadURL,
		secureuri:false,
		fileElementId:fileelement,
		dataType: 'json',
		success: function (data,status){
				$('#uploadModal').modal('hide');
				if ( typeof(data)=='undefined' ){
					alert('由于第三方插件存在兼容性问题,目前站长仍在努力修复中,请勿使用IE浏览器上传文件.');
					return ;
				}
				switch (data.status){
					case 0:
						alert(data.file);
						break;
					case 1:
						$('#img'+fileelement).attr('src',IndexURL.substring(0, IndexURL.lastIndexOf('/'))+'/Public/Upload/Photo/pic_'+data.file);
						alert("上传成功.");
						break;
					default:
						alert("上传失败.");
				}
			},
		error: function (data, status, e)//服务器响应失败处理函数
				{
					$('#uploadModal').modal('hide');
					alert(e);
				}
		});
}

function Com_PicUpload(){
	if ( $('#btn_upload1').size()>0 ) {

		$('#btn_upload1').click(function(){
			$('#p1').click();
		});
		$('#btn_upload2').click(function(){
			$('#p2').click();
		});
		$('#btn_upload3').click(function(){
			$('#p3').click();
		});

		$('#p1').live('change',function(){
			InLiveChangeFun('p1');
		});
		$('#p2').live('change',function(){
			InLiveChangeFun('p2');
		});
		$('#p3').live('change',function(){
			InLiveChangeFun('p3');
		});
	}
}

function Pic_Upload(){
	$('#uploadModal').modal({
					backdrop:true,
					keyboard:true,
					show:true
	}); 
    $('#uploadModal').modal('show');
	 
	 if ( $('#photo').val() ) {
		 $.ajaxFileUpload({
			url:FormSubmitURL,
			secureuri:false,
			fileElementId:'photo',
			dataType: 'json',
			success: function (data,status)
			{
				$('#uploadModal').modal('hide');
				if ( typeof(data.status)=='undefined' ){
					alert('由于第三方插件存在兼容性问题,目前站长仍在努力修复中,请先使用火狐浏览器上传文件.');
					return ;
				}
				switch (data.status){
					case 0:
						alert("修改失败.");break;
					case 1:
						$.post(FormSubmitURL, $("#submitForm").serialize(),function (data){
							DispatchFun_Office(data.type,data.gp,data.status);
						},'json');break;
					default:
						alert(data.status);
				}
			},
			error: function (data, status, e)//服务器响应失败处理函数
			{
				$('#uploadModal').modal('hide');
				alert(e);
			}
			})
	 } else {
		 $.post(FormSubmitURL, $("#submitForm").serialize(),function (data){
				DispatchFun_Office(data.type,data.gp,data.status);
		},'json');
	 }
	return false;
}

function GetDetial_C(){
	if ( typeof(DetialURL)!="undefined" && $('#xrzx') ){
		$.get(DetialURL,function (data){
			if (data){
				$('#stmc').val(data.cname)
				$('#xrzx').val(data.cchairman)
				$('#lxfs').val(data.ccontact)
				$('#jj').val(data.cbrief)
				if (data.clogo)
					$('#img').attr('src',IndexURL.substring(0, IndexURL.lastIndexOf('/'))+'/Public/Upload/HeadPhoto/pic_'+data.clogo)
			}
		},'json');
	}
}

function SubmitFunction_gp3(){
	if ($('#btn_pass_app').size()>0){
		$('#btn_pass_app').click(function (){
			if ( !confirm("你确认要通过该申请么?") ) return;
			if ( Sstatus == 'U' && app_type == '6'){
				$.post(IndexURL.substring(0, IndexURL.lastIndexOf('.'))+'/Check',{'id' : id, 'type':'2','s': $('#spyj').val()},function(data){
					if (data.status==1) {
						alert("已通过电子审核.");
						location.href=document.referrer;
					} else {
						alert("操作失败!");
					}
				});
			} else if ( Sstatus == 'U' && (app_type !='2' && app_type!='13')){
				$.post(IndexURL.substring(0, IndexURL.lastIndexOf('.'))+'/Check',{'id' : id, 'type':'3','s': $('#spyj').val()},function(data){
					if (data.status==1) {
						alert("已通过团联审核.");
						location.href=document.referrer;
					} else {
						alert("操作失败!");
					}
				});
			} else if ( Sstatus == 'D' || Sstatus == 'O' || app_type =='2' || app_type=='13'){
				$.post(IndexURL.substring(0, IndexURL.lastIndexOf('.'))+'/Check',{'id' : id, 'type':'1','s': $('#spyj').val()},function(data){
					if (data.status==1) {
						alert("已通过该申请.");
						location.href=document.referrer;
					} else {
						alert("操作失败!");
					}
				});
			} else {
				alert("类型代码错误!");
			};
		});
		$('#btn_refuse_app').click(function (){
			if ( !confirm("该申请将会被拒绝!你确定继续么?") ) return;
			$.post(IndexURL.substring(0, IndexURL.lastIndexOf('.'))+'/Check',{'id' : id, 'type':'0','s': $('#spyj').val()},function(data){
				if (data.status==1) {
					alert("已拒绝该申请.");
					location.href=document.referrer;
				}
				alert("操作失败!");
			});
		});
	}
}

function SubmitFcuntion_gp2(){
	if ($('#btn_del').size()>0){
		$('#btn_del').click(function (){
			if ( !confirm("删除申请是不可回复的,你确定要删除么?") ) return;
			$.post(IndexURL.substring(0, IndexURL.lastIndexOf('.'))+'/DelTable',{'id' : id},function(data){
				if (data.status==1) {
					alert("已成功删除该申请.");
					location.href=document.referrer;
				} else
					alert("操作失败!");
			});
		});
	}
}

function GetDetial_SignUp(){
	if ( typeof(Json)!="undefined" && $('#btn_pass').size()>0 )
	{
				$('body').find('input[type=text]').each(function (){
					$(this).val(Json[$(this).attr('name')]);
				});
				/*
				if ( data.status != 0 )
					$('#styy').html("<tr><td rowspan='3' id='table-lable'>社团意见</td><td rowspan='3' colspan='5'><textarea class='input-xlarge span8' name='suggestion' id='suggestion' rows='6'></textarea></td></tr>");
				else
					$('#bdtj').html("<div class='form-actions'><div class='pull-right'><button type='submit' class='btn btn-primary'>修改</button> <button type='reset' class='btn'>重置</button></div></div>");*/
				
				$('#grjj').text(Json.grjj);
				
				if ( $("input[name='xb'][value='男']").val() == Json['xb'] )
					$("input[name='xb'][value='男']").attr("checked",true); 
				else
					$("input[name='xb'][value='女']").attr("checked",true); 
					
				if ( $("input[name='fctj'][value='是']").val() == Json['fctj'] )
					$("input[name='fctj'][value='是']").attr("checked",true); 
				else
					$("input[name='fctj'][value='否']").attr("checked",true); 
					
				$('body').find('input[type=text]').each(function (){
					$(this).attr('readonly',true);
				});
				$('#grjj').attr('readonly',true);
				if ( Sstatus == 0)
					$('#suggestion').attr('readonly',false);
				else {
					$('#suggestion').attr('readonly',true);
					$('#suggestion').text(dSuggestion);
					$('#btn_pass').attr('disabled',true);
					$('#btn_refuse').attr('disabled',true);
				}
				
				
				if ( $('#btn_pass') ){
					$('#btn_pass').click(function (){
						$.post(FormSubmitURL,{'action' : 1,'suggestion' : $('#suggestion').text()},function (data){
							alert(data);
							location.href=document.referrer;
						});
					});
					$('#btn_refuse').click(function (){
						$.post(FormSubmitURL,{'action' : 0,'suggestion' : $('#suggestion').text()},function (data){
							alert(data);
							location.href=document.referrer;
						});
					});
				}
	}
}

function GetDetial_App(){
	if ( typeof(Json)!="undefined" && ( $('#btn_del').size()>0 || $('#btn_pass_app').size()>0 ) ){
		$('body').find('input[type=text]').each(function (){
			$(this).val(Json[$(this).attr('name')]);
		});
		
		if ($('#btn_pass_app').size()>0){
			$('body').find('input[type=text]').each(function (){
					$(this).attr('readonly',true);
				});
		}
		
		switch (app_type){
			case 1:
				if ( $("input[name='wldwop'][value='无']").val() == Json['wldwop'] )
					$("input[name='wldwop'][value='无']").attr("checked",true); 
				else
					$("input[name='wldwop'][value='有']").attr("checked",true); 
				if ( $("input[name='ywlbop'][value='无']").val() == Json['ywlbop'] )
					$("input[name='ywlbop'][value='无']").attr("checked",true); 
				else
					$("input[name='ywlbop'][value='有']").attr("checked",true); 
				if ( $("input[name='hdxsop'][value='表演类']").val() == Json['hdxsop'] )
					$("input[name='hdxsop'][value='表演类']").attr("checked",true); 
				else if ( $("input[name='hdxsop'][value='竞赛类']").val() == Json['hdxsop'] )
					$("input[name='hdxsop'][value='竞赛类']").attr("checked",true); 
				else if ( $("input[name='hdxsop'][value='讲座类']").val() == Json['hdxsop'] )
					$("input[name='hdxsop'][value='讲座类']").attr("checked",true); 
				else
					$("input[name='hdxsop'][value='其它']").attr("checked",true);
				if ( $("input[name='zjxqop'][value='无']").val() == Json['zjxqop'] )
					$("input[name='zjxqop'][value='无']").attr("checked",true); 
				else
					$("input[name='zjxqop'][value='有']").attr("checked",true);  
				$('#hdcd').text(Json.hdcd);
				if ($('#btn_pass_app').size()>0) $('#hdcd').attr('readonly',true);
				$('#filename').attr('href',IndexURL.substring(0, IndexURL.lastIndexOf('/'))+'/Public/Upload/File/'+$('#fname').val());
				$('#filename').text($('#frname').val());
				break;
			case 2:
				$('#hdcd').text(Json.hdcd);
				if ($('#btn_pass_app').size()>0) $('#hdcd').attr('readonly',true);
				break;
			case 5:
				$('#qtsm').text(Json.qtsm);
				if ($('#btn_pass_app').size()>0) $('#qtsm').attr('readonly',true);
				break;
			case 6:
				if ( $("input[name='xcfs'][value='横幅']").val() == Json['xcfs'] )
					$("input[name='xcfs'][value='横幅']").attr("checked",true); 
				else
					$("input[name='xcfs'][value='喷绘']").attr("checked",true); 
				if ( $("input[name='dzbsh'][value='已通过']").val() == Json['dzbsh'] )
					$("input[name='dzbsh'][value='已通过']").attr("checked",true); 
				else
					$("input[name='dzbsh'][value='未通过']").attr("checked",true); 
				$('#filename').attr('href',IndexURL.substring(0, IndexURL.lastIndexOf('/'))+'/Public/Upload/File/'+$('#fname').val());
				$('#filename').text($('#frname').val());
				break;
			case 13:
				$('#wlryhzz').text(Json.wlryhzz);
				$('#hdyyjyqxg').text(Json.hdyyjyqxg);
				$('#hdnr').text(Json.hdnr);
				$('#bz').text(Json.bz);
				$('#cdsq').text(Json.cdsq);
				$('#filename').attr('href',IndexURL.substring(0, IndexURL.lastIndexOf('/'))+'/Public/Upload/File/'+$('#fname').val());
				$('#filename').text($('#frname').val());
				if ( $("input[name='hdxsop'][value='表演类']").val() == Json['hdxsop'] )
					$("input[name='hdxsop'][value='表演类']").attr("checked",true); 
				else if ( $("input[name='hdxsop'][value='竞赛类']").val() == Json['hdxsop'] )
					$("input[name='hdxsop'][value='竞赛类']").attr("checked",true); 
				else if ( $("input[name='hdxsop'][value='讲座类']").val() == Json['hdxsop'] )
					$("input[name='hdxsop'][value='讲座类']").attr("checked",true); 
				else
					$("input[name='hdxsop'][value='其它']").attr("checked",true);
				
		}
	}
}

function type2_10(status){
	switch (status){
		case 0:
			alert("用户不存在.");break;
		case 1:
			alert("原密码错误.");break;
		case 2:
			alert("修改成功.");break;
	}
	$('#submitForm').find('input').val("");
	return;
}

function type2_8(status){
	switch (status){
		case 0:
			alert("修改失败.");break;
		case 1:
			alert("修改成功.");break;
		default:
			alert(status);break;
	}
	$('#uploadModal').modal('hide');
	return;
}

function type2_approval(status){
	switch (status){
		case -2:
			alert("你所提交的活动编号不正确!");break;
		case -1:
			alert("只有社团管理员可以提交表单");break;
		case 0:
			alert("申请提交失败");break;
		case 1:
			alert("申请提交成功");
			window.location.href = IndexURL;
			break;
		case -11:
			alert("越权操作.");break;
		case 11:
			alert("修改成功");
			location.href=document.referrer;
			break;
		case 10:
			alert("修改失败.");break;
	}
}

$(document).ready(function(){
	$('.datepicker').datepicker()
	GetDetial_C(); 
	GetDetial_SignUp(); 
	GetDetial_App();
	SubmitFunction_gp3();
	SubmitFcuntion_gp2();
	File_Upload();
	Com_PicUpload();
})



















function DispatchFun_Office(type,gp,status){
	switch (gp) {
	case '1':
		DispatchFun_Office_GP1(type,status);break;
	case '2':
		DispatchFun_Office_GP2(type,status);break;
	case '3':
		DispatchFun_Office_GP3(type,status);break;
	default:
		return;
	}
}

function DispatchFun_Office_GP1(type,status){
	switch (type) {
	default:
		return;
	}
}

function DispatchFun_Office_GP2(type,status){
	switch (type) {
	case '1':
	case '2':
	case '3':
	case '4':
	case '5':
	case '6':
	case '13':
		type2_approval(status);break;
	case '8':
		type2_8(status);break;
	case '10':
		type2_10(status);break;
	default:
		return;
	}
}

function DispatchFun_Office_GP3(type,status){
	console.log(type + " " + status);
	switch (type) {
	default:
		return;
	}
}
