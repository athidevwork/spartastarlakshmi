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

function validateExpiry(){
	var x = $('#peexpiry').val();
	if(x == ''){ $('#peexpiry').focus(); return false; }
	var xx = x.split("/");
	if(xx[0] > 12) { $('#peexpiry').val(''); $('#peexpiry').focus(); return false; }
	if(xx[1] < 2000 || xx[1] == 'undefined') { $('#peexpiry').val(''); $('#peexpiry').focus(); return false; }
}

function savePurchaseItems(){
	var amt = parseFloat($('#lblpamount').html()), adj = parseFloat($('#lblpadj').val());
	var len = $('#tbl-purchase-entry > tbody > tr').length;
	var peinvoiceno = $('#peinvoiceno').val(), pepurchaseno = $('#pepurchaseno').val();
	if((amt+adj) != 0){ alert('Purchase Amount greater / lesser than Invoice Amount'); return false; }
	if(len == 0){ alert('Enter atleast one Item'); return false; }
	$.ajax({
        type: 'post',
        url: 'manage-purchase/save-purchase-info.php?invoiceno='+peinvoiceno,
        success: function(msg) {
			alert(msg);
			window.location.href = 'purchase-entry.php';
        }
    });
}

function returnProductInfo(){
	var product = $.trim($('#peproductname').val()), type = $('#petype').val();
	if(product == '' || type == 'SELECT') return false;
	$.ajax({
        type: 'post',
        url: 'manage-purchase/return-product-info.php?product='+encodeURIComponent(product)+"&type="+type,
        success: function(msg) {
			var x = JSON.parse(msg);
			if(x.mrp == null){
				alert('Enter Valid Product Name');
				$('#peproductname').val(''); $('#peproductname').focus(); 	$('#petype').val('SELECT');
				return false;
			}
			$('#pemrp').val(x.mrp);		$('#pevatp').val(x.vat);	
        }
    });
}

function addPurchaseItems(){
	var prod = $.trim($('#peproductname').val()), qty = $.trim($('#peqty').val()), free = $.trim($('#pefree').val()), batch = $.trim($('#pebatch').val()),
		expiry = $.trim($('#peexpiry').val()), price = $.trim($('#pepprice').val()), mrp = $.trim($('#pemrp').val());
	if(prod == '' || qty == '' || free == '' || batch == '' || expiry == '' || price == '' || mrp == '')
		return false;
	$.ajax({
        type: 'post',
        url: 'manage-purchase/new-purchase-item.php',
		data: $('#frmPurchaseEntry').serialize(),
        success: function(msg) {
			$('#peproductname').val(''); $('#peqty').val(''); 	$('#pefree').val('0'); 	$('#pebatch').val('');
			$('#peexpiry').val(''); 	$('#pepprice').val(''); $('#pemrp').val('');	$('#petype').val('SELECT');		$('#pevat').val(''); $('#pevat').val('');
			var x = JSON.parse(msg);
			var tr = "<tr><td>"+x.code+"</td><td>"+x.descrip+"</td><td>"+x.qty+"</td><td>"+x.free+"</td><td>"+x.batch+"</td><td>"+x.expiry+"</td><td>"+x.price+"</td><td>"+x.mrp+"</td><td>"+x.vat+"</td><td>"+x.gross+"</td><td>"+x.net+"</td><td><img src='images/delete.png' style='width: 24px; cursor: pointer;' onClick='javascript:deleteItem(this,"+x.id+")' /></td></tr>";
			$('#tbl-purchase-entry > tbody').append(tr);
			var tot = x.qty * x.price;
			$('#lblpamount').html(parseFloat(tot + parseFloat($('#lblpamount').html())).toFixed(2));
        }
    });
}

$('#invoicetype').on('change',function(){
	var x = $('#invoicetype').val();
	if(x == 0){
		$('#divcash').hide();
		$('#divcr').hide();
		$('#paymentdate').val('');	$('#paymentamt').val('');	$('#payable').val('');	$('#creditdate').val('');
	}else if(x == 'CASH'){
		$('#divcash').show();
		$('#creditdate').val('');
		$('#divcr').hide();
	}else if(x == 'CR'){
		$('#divcr').show();
		$('#paymentdate').val('');	$('#paymentamt').val('');	$('#payable').val('');
		$('#divcash').hide();
	}
});

function deletePurchase(){
	var id = $('#purchaseid').val();
	if(id == '') return false;
	if(confirm("Are you sure to delete this Purchase details?")){
		$.ajax({
			type: 'post',
			url: 'manage-purchase/delete-purchase-info.php?id='+id,
			success: function(msg) {
				alert(msg);
				window.location.href = 'purchase-entry.php';
			}
		});
	}
}

function supplierDetails(){
	var supp = $.trim($('#supplier').val());
	if(supp == '') return false;
	$.ajax({
        type: 'post',
        url: 'manage-supplier/return-supplier-info.php?supplier='+encodeURIComponent(supp),
        success: function(msg) {
			var x = JSON.parse(msg);
			if(x.id == null){
				alert('Enter Valid Supplier Name');
				$('#supplier').val('');
				$('#address1').val('');	$('#address2').val('');	$('#supplierid').val('');
				$('#address3').val('');	$('#contact1').val('');
				return false;
			}
			$('#address1').val(x.add1);	$('#address2').val(x.add2);	$('#supplierid').val(x.id);
			$('#address3').val(x.add3);	$('#contact1').val(x.con1);
        }
    });
}

function savePurchase(){
	var supp = $.trim($('#supplier').val()), invoiceno = $.trim($('#invoiceno').val()), invoiceamt = $.trim($('#invoiceamt').val());
	var invoicetype = $('#invoicetype').val();
	if(supp == ''){ alert('Supplier Details Cannot be Left Blank'); return false; }
	if(invoiceno == ''){ alert('Invoice # Cannot be Left Blank'); return false; }
	if(invoiceamt == ''){ alert('Invoice Amount Cannot be Left Blank'); return false; }
	if(invoicetype == 0){ alert('Select Invoice Type'); return false; }
	else if(invoicetype == 'CASH'){
		if($.trim($('#paymentdate').val()) == ''){ alert('Payment Date Cannot be Left Blank'); return false; }
		if($.trim($('#paymentamt').val()) == ''){ alert('Amount Cannot be Left Blank'); return false; }
		if($.trim($('#payable').val()) == ''){ alert('Payable Cannot be Left Blank'); return false; }
	}else if(invoicetype == 'CR'){
		if($.trim($('#creditdate').val()) == ''){ alert('Credit Date Cannot be Left Blank'); return false; }
	}
	
	var paymentamt = $('#paymentamt').val();
	if(parseFloat(invoiceamt) < parseFloat(paymentamt)){
		alert('Payment Amount must be lesser or equal to Invoice amount');
		$('#paymentamt').val('');
		return false;
	}
	
	$.ajax({
        type: 'post',
        url: 'manage-purchase/new-purchase-entry.php',
		data: $('#frmPurchase').serialize(),
        success: function(msg) {
			if($.trim(msg) != "ERROR"){
				$('#purchaseid').val($.trim(msg));		$('#pepurchaseno').val($.trim(msg));
				$('#peinvoiceno').val($.trim(invoiceno));
				window.location.href = 'purchase-entry.php';
			}else
				alert(msg);
        }
    });
}

$('#mdlPurchase').on('show.bs.modal', function (event) {
	var inv = $('#peinvoiceno').val(), pur = $('#pepurchaseno').val();
	if(pur == '' || inv == '') return false;
	$.ajax({
        type: 'post',
        url: 'manage-purchase/return-purchase-entry.php?pur='+pur+"&inv="+inv,
        success: function(msg) {
			var x = JSON.parse(msg);
			var tot = 0;
			for(var i=0;i<x.length;i++){
				var tr = '<tr><td>'+x[i].code+'</td><td>'+x[i].descrip+'</td><td>'+x[i].qty+'</td><td>'+x[i].free+'</td><td>'+x[i].batch+'</td><td>'+x[i].expiry+'</td><td>'+x[i].price+'</td><td>'+x[i].mrp+'</td><td>'+x[i].vat+'</td><td>'+x[i].gross+'</td><td>'+x[i].net+'</td><td><img src="images/delete.png" style="width: 24px; cursor: pointer;" onClick="javascript:deleteItem(this,'+x[i].id+')" /></td></tr>';
				tot += parseFloat(x[i].net);
				$('#tbl-purchase-entry > tbody').append(tr);
			}
			$('#lblpamount').html(parseFloat(tot - parseFloat($('#lblpamount').html())).toFixed(2));
        }
    });
});

function deleteItem(img, x){
	var row = img.closest("tr");
	var qty = $(row).find("td").eq(2).text();
	var price = $(row).find("td").eq(6).text();
	var amt = parseFloat(qty) * parseFloat(price);
	if(confirm("Are you sure to delete?")){
		$.ajax({
			type: 'post',
			url: 'manage-purchase/delete-purchase-entry.php?id='+x,
			success: function(msg) {
				if(msg == 'ok'){
					row.remove();
					$('#lblpamount').html("-"+(amt - parseFloat($('#lblpamount').html())));
				}else
					alert(msg);
			}
	   });
	}
}