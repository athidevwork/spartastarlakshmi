// JavaScript Document

$(".number").blur(function(){
	var x = $(this);
	if(!$.isNumeric(x.val())){ x.css("border","2px dotted red"); x.val(''); return false; }
	else{ x.css("border","1px solid #d5d5d5"); }
});
$(".mand").blur(function(){
	var x = $(this);
	if($.trim(x.val()) == ''){ x.css("border","2px dotted red"); x.focus(); return false; }
	else{ x.css("border","1px solid #d5d5d5"); }
});

function deleteItem(img, x){
	var row = img.closest("tr"); 
	if(confirm("Are you sure to delete?")){
		$.ajax({
			type: 'post',
			url: 'manage-bill/edit-delete-billed-item.php?id='+x,
			success: function(msg) {
				var xx = msg.split("~")
				alert(xx[0]);
				$('#lblAmount').html((parseFloat($('#lblAmount').html()) - parseFloat(xx[1])).toFixed(2));
				row.remove();
			}
	   });
	}
}

function retExpiry(){
	var prod = $('#pname').val(), batch = $('#batch').val();
	if(batch == 'SELECT') return false;
	$.ajax({
		type: 'post',
		url: 'manage-bill/return-expiry.php?prod='+encodeURIComponent(prod)+"&batch="+batch,
		success: function(msg) {
			var xx = JSON.parse(msg);
			$('#expiry').empty();
			$('#expiry').append(new Option("SELECT"));
			for(var i=0;i<xx.length;i++)
				$('#expiry').append(new Option(xx[i].expiry));
		}
	});
}

function retBatchNo(){
	var prod = $('#pname').val();
	if($.trim(prod) == '') return false;
	$.ajax({
		type: 'post',
		url: 'manage-bill/return-batchno.php?prod='+encodeURIComponent(prod),
		success: function(msg) {
			if($.trim(msg) == ''){
				alert('No Product Found !');	$('#pname'+x).val('');
			}else if($.trim(msg) == 'error1'){
				alert('Invalid Product !');		$('#pname'+x).val('');
			}else{
				var xx = JSON.parse(msg);
				$('#batch').empty();
				$('#batch').append(new Option("SELECT"));
				for(var i=0;i<xx.length;i++)
					$('#batch').append(new Option(xx[i].batch));
			}
		}
	});
}

function validateQty(){
	var prod = $('#pname').val(), batch = $('#batch').val(), qty = $('#qty').val(), expiry = $('#expiry').val();
	if(batch == 'SELECT' || prod == '' || qty == '' || qty == 0 || expiry == '') return false;
	$.ajax({
		type: 'post',
		url: 'manage-bill/return-qty.php',
		data: {
			prod: encodeURIComponent(prod),
			batch: batch,
			qty: qty,
			expiry: expiry,
		},
		success: function(msg) {
			if($.trim(msg) != ''){
				alert(msg);
				$('#qty').val('');
			}
		}
	});
}

function addBillingItems(){
	var prod = $('#pname').val(), qty = $('#qty').val(), batch = $('#batch').val(), expiry = $('#expiry').val();
	if(prod == '' || qty == '' || batch == 'SELECT' || expiry == '') return false;
	$.ajax({
		type: 'post',
		url: 'manage-bill/edit-billing-items.php',
		data: {
			prod: encodeURIComponent(prod),
			batch: batch,
			qty: qty,
			expiry: expiry,
			billno: $('#billno').val(),
		},
		success: function(msg) {
			var t = JSON.parse(msg);
			var tr = "<tr><td>"+t.code+"</td><td>"+t.desc+"</td><td>"+t.qty+"</td><td>"+t.batch+"</td><td>"+t.expi+"</td><td>"+t.amt+"</td><td><img src='images/delete.png' style='height:24px; cursor:pointer;' onClick='javascript:deleteItem(this,"+t.id+")'></td></tr>";
			$('#tbl-list > tbody').append(tr);
			$('#lblAmount').html((parseFloat($('#lblAmount').html()) + parseFloat(t.amt)).toFixed(2));
			$('#pname').val(''); $('#qty').val(''); $('#batch').empty(); $('#expiry').empty(); $('#batch').append(new Option('SELECT')); $('#expiry').append(new Option('SELECT'));
		}
	});
}

function closeBill(p){
	var pm = $('#paymentmode').val();
	if(pm == 'SELECT') return false;
	$.ajax({
		type: 'post',
		url: 'manage-bill/edit-close-bill.php',
		data: {
			pm: pm,
			billno: $('#billno').val(),
		},
		success: function(msg) {
			if($.isNumeric(msg)){
				if(p == '1')
					var win = window.open("printbill.php?billno="+msg);
				window.location.href = 'sales-return.php';
			}else
				alert("ERROR : "+msg);
		}
	});
}

function getBill(){
	var billno = $.trim($('#billno').val());
	if(billno == '') return false;
	window.location.href = 'sales-return.php?billno='+billno;
}
