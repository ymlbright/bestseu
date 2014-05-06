$(document).ready(function(){
	VoteInit();
});

function CheckFunction(data){
	switch (data.status ) {
		case -1:
			$('#voteModal').modal({
				backdrop:true,
				keyboard:true,
				show:true
			}); 
			$('#voteModal').toggle();
			break;
		case 0:
			alert(data.msg);
			break;
		case 1:
			alert("投票成功!");
	}
}
 
function GetIdcode(){
 	$('#vcodeimg').attr('src',VCodeURL+'?key='+ new Date().getTime());
}

var flag=0;
function GetIMG(){
	if (flag==0){
		GetIdcode();
		flag=1;
	}
}

function VoteInit(){
	if ( $('#btn_vote_1').size()>0 ) {
		$('#btn_vote_1').click(function(){
			$.post(VoteSubmitURL, {'vtype' : 1 ,'cid' : $('#cid').val()},function (data){CheckFunction(data);},'json');
		});

		$('#btn_revote').click(function (){
			$('#voteModal').modal('hide');
			$.post(VoteSubmitURL, {'vtype' : 1 ,'cid' : $('#cid').val(),'vcode' : $('#vcode').val()},function (data){CheckFunction(data);},'json');
			flag=0;
			$('#vcodeimg').attr('src','');
		});
	}
}