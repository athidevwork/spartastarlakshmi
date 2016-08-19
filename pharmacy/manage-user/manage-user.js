// JavaScript Document

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#imgPhoto').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}
function readNewURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#newimgPhoto').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}
function newUser(){
	var username = $('#newUserName').val(), userid = $('#newUserId').val(), pass = $('#newPassword').val(), role = $('#newRole').val();
	var	opt1 = $('#opt1').is(':checked') ? "1" : "0",	opt2= $('#opt2').is(':checked') ? "1" : "0",
		opt3 = $('#opt3').is(':checked') ? "1" : "0",	opt4 = $('#opt4').is(':checked') ? "1" : "0",
		opt5 = $('#opt5').is(':checked') ? "1" : "0",	opt6 = $('#opt6').is(':checked') ? "1" : "0",
		opt7 = $('#opt7').is(':checked') ? "1" : "0",	opt8 = $('#opt8').is(':checked') ? "1" : "0",
		opt9 = $('#opt9').is(':checked') ? "1" : "0",	opt10 = $('#opt10').is(':checked') ? "1" : "0",
		opt11 = $('#opt11').is(':checked') ? "1" : "0",	opt12 = $('#opt12').is(':checked') ? "1" : "0",
		opt13 = $('#opt13').is(':checked') ? "1" : "0", opt14 = $('#opt14').is(':checked') ? "1" : "0",
		opt15 = $('#opt15').is(':checked') ? "1" : "0", opt16 = $('#opt16').is(':checked') ? "1" : "0";
	if(username == "" || userid == "" || pass == "" || role == 0)
		return false;
	var photo = $('#newPhoto').prop('files')[0];
	var fd = new FormData();
	fd.append('photo',photo);
	fd.append('username',username);
	fd.append('userid',userid);
	fd.append('pass',pass);
	fd.append('role',role);
	fd.append('opt1',opt1);
	fd.append('opt2',opt2);
	fd.append('opt3',opt3);
	fd.append('opt4',opt4);
	fd.append('opt5',opt5);
	fd.append('opt6',opt6);
	fd.append('opt7',opt7);
	fd.append('opt8',opt8);
	fd.append('opt9',opt9);
	fd.append('opt10',opt10);
	fd.append('opt11',opt11);
	fd.append('opt12',opt12);
	fd.append('opt13',opt13);
	fd.append('opt14',opt14);
	fd.append('opt15',opt15);
	fd.append('opt16',opt16);

	$.ajax({
        type: 'post',
        url: 'manage-user/new-user-details.php?'+fd,
		contentType: false,
		processData: false,
		data: fd,
        success: function(msg) {
			alert(msg);
			window.location.href="manage-user.php";
        }
    });
}
function updateUser(){
	var username = $('#UserName').val(), userid = $('#UserId').val(), pass = $('#Password').val(), role = $('#Role').val(), dbid = $('#DBid').val();
	var	opt1 = $('#xopt1').is(':checked') ? "1" : "0",		opt2= $('#xopt2').is(':checked') ? "1" : "0",
		opt3 = $('#xopt3').is(':checked') ? "1" : "0",		opt4 = $('#xopt4').is(':checked') ? "1" : "0",
		opt5 = $('#xopt5').is(':checked') ? "1" : "0",		opt6 = $('#xopt6').is(':checked') ? "1" : "0",
		opt7 = $('#xopt7').is(':checked') ? "1" : "0",		opt8 = $('#xopt8').is(':checked') ? "1" : "0",
		opt9 = $('#xopt9').is(':checked') ? "1" : "0",		opt10 = $('#xopt10').is(':checked') ? "1" : "0",
		opt11 = $('#xopt11').is(':checked') ? "1" : "0",	opt12 = $('#xopt12').is(':checked') ? "1" : "0",
		opt13 = $('#xopt13').is(':checked') ? "1" : "0", opt14 = $('#xopt14').is(':checked') ? "1" : "0",
		opt15 = $('#xopt15').is(':checked') ? "1" : "0", opt16 = $('#xopt16').is(':checked') ? "1" : "0";
	if(username == "" || userid == "")
		return false;
	var photo = $('#Photo').prop('files')[0];
	var fd = new FormData();
	fd.append('photo',photo);
	fd.append('username',username);
	fd.append('userid',userid);
	fd.append('pass',pass);
	fd.append('role',role);
	fd.append('opt1',opt1);
	fd.append('opt2',opt2);
	fd.append('opt3',opt3);
	fd.append('opt4',opt4);
	fd.append('opt5',opt5);
	fd.append('opt6',opt6);
	fd.append('opt7',opt7);
	fd.append('opt8',opt8);
	fd.append('opt9',opt9);
	fd.append('opt10',opt10);
	fd.append('opt11',opt11);
	fd.append('opt12',opt12);
	fd.append('opt13',opt13);
	fd.append('opt14',opt14);
	fd.append('opt15',opt15);
	fd.append('opt16',opt16);
	fd.append('id',dbid);
	$.ajax({
        type: 'post',
        url: 'manage-user/update-user-details.php?'+fd,
		contentType: false,
		processData: false,
		data: fd,
        success: function(msg) {
			alert(msg);
			window.location.href="manage-user.php";
        }
    });
}
$('table').on('click', 'a[id=edit]', function (e) {
	var txt = $(this).attr("data-val");
	$.ajax({	
		url: 'manage-user/return-edit-user-info.php?id='+txt,
		type: 'POST',
		success:function(msg){
			var x = msg.split("~");
			$('#DBid').val(x[4]);
			$('#UserName').val(x[0]);	$('#UserId').val(x[1]);
			$('#Role').val(x[2]);
			$('#imgPhoto').attr("src", "return-user-img.php?id="+x[4]);
			if(x[5] == 1) $('#xopt1').prop("checked", true); else $('#xopt1').prop("checked", false);
			if(x[6] == 1) $('#xopt2').prop("checked", true); else $('#xopt2').prop("checked", false);
			if(x[7] == 1) $('#xopt3').prop("checked", true); else $('#xopt3').prop("checked", false);
			if(x[8] == 1) $('#xopt4').prop("checked", true); else $('#xopt4').prop("checked", false);
			if(x[9] == 1) $('#xopt5').prop("checked", true); else $('#xopt5').prop("checked", false);
			if(x[10] == 1) $('#xopt6').prop("checked", true); else $('#xopt6').prop("checked", false);
			if(x[11] == 1) $('#xopt7').prop("checked", true); else $('#xopt7').prop("checked", false);
			if(x[12] == 1) $('#xopt8').prop("checked", true); else $('#xopt8').prop("checked", false);
			if(x[13] == 1) $('#xopt9').prop("checked", true); else $('#xopt9').prop("checked", false);
			if(x[14] == 1) $('#xopt10').prop("checked", true); else $('#xopt10').prop("checked", false);
			if(x[15] == 1) $('#xopt11').prop("checked", true); else $('#xopt11').prop("checked", false);
			if(x[16] == 1) $('#xopt12').prop("checked", true); else $('#xopt12').prop("checked", false);
			if(x[17] == 1) $('#xopt13').prop("checked", true); else $('#xopt13').prop("checked", false);
			if(x[18] == 1) $('#xopt14').prop("checked", true); else $('#xopt14').prop("checked", false);
			if(x[19] == 1) $('#xopt15').prop("checked", true); else $('#xopt14').prop("checked", false);
			if(x[20] == 1) $('#xopt16').prop("checked", true); else $('#xopt14').prop("checked", false);
			
		}
	});
	var modal = $('#modal-update');
	modal.modal('show');
});
$('table').on('click', 'a[id=view]', function (e) {
	var txt = $(this).attr("data-val");
	$.ajax({	
		url: 'manage-user/return-user-info.php?id='+txt,
		type: 'POST',
		success:function(msg){
			var x = msg.split("~");
			$('#txtUserName').html(x[0]);	$('#txtUserId').html(x[1]);
			$('#txtRole').html(x[2]);		$('#txtStatus').html(x[3]);
			$('#txtPhoto').attr("src", "return-user-img.php?id="+x[4]);
			$('#vopt1').html(x[5]);		$('#vopt2').html(x[6]);		$('#vopt3').html(x[7]);		$('#vopt4').html(x[8]);
			$('#vopt5').html(x[9]);		$('#vopt6').html(x[10]);
			$('#vopt7').html(x[11]);	$('#vopt8').html(x[12]);
			$('#vopt9').html(x[13]);	$('#vopt10').html(x[14]);	$('#vopt11').html(x[15]);
			$('#vopt12').html(x[16]);	$('#vopt13').html(x[17]); $('#vopt14').html(x[18]); $('#vopt15').html(x[19]); $('#vopt16').html(x[20]);
		}
	});
	var modal = $('#modal-view');
	modal.modal('show');
});
$('table').on('click', 'a[id=disable]', function (e) {
	var txt = $(this).attr('data-val');
	var rid = $(this).closest("tr").index();
	if(confirm("Sure to disable user?")){
		$.ajax({	
			url: 'manage-user/disable-user.php?id='+txt,
			type: 'POST',
			success:function(msg){
				var x = msg.split("~");
				if(x[0] != 'ok'){
					alert(msg);
					return false;
				}
				window.location.href="manage-user.php";
			}
		});
	}
});
$('table').on('click', 'a[id=enable]', function (e) {
	var txt = $(this).attr('data-val');
	var rid = $(this).closest("tr").index();
	if(confirm("Sure to enable user?")){
		$.ajax({	
			url: 'manage-user/enable-user.php?id='+txt,
			type: 'POST',
			success:function(msg){
				var x = msg.split("~");
				if(x[0] != 'ok'){
					alert(msg);
					return false;
				}
				window.location.href="manage-user.php";
			}
		});
	}
});
$('table').on('click', 'a[id=delete]', function (e) {
	var txt = $(this).attr('data-val');
	var rid = $(this).closest("tr").index();
	if(confirm("Sure to delete user?")){
		$.ajax({	
			url: 'manage-user/delete-user.php?id='+txt,
			type: 'POST',
			success:function(msg){
				if(msg != 'ok'){
					alert(msg);
					return false;
				}
				alert('User Record Deleted !');
				window.location.href = 'manage-user.php';
			}
		});
	}
});