
    function delete_row(x){
        var box = $("#mb-remove-row");
		var row = x.closest("tr");
		box.addClass("open");
		
		$("#no").off().click(function() {
			box.removeClass("open");
			//alert();
			//x.preventDefault();
			//x.stopImmediatePropagation();
		});	
       
	   $( "#yes" ).off().click(function() {
			row.remove();
            box.removeClass("open");
			//alert(x.closest("tr").attr("id"));
			 
			//x.preventDefault();
			//x.stopImmediatePropagation();
		});
    }
