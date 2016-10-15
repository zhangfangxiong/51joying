$('.yyauto').each(function(){
	var source = $(this).attr('source');
	source += source.indexOf('?') == -1 ? '?' : '&';
	var ivalue = $(this).attr('ivalue');
	var ishow = $(this).attr('ishow');
	var yyele = $(this);
	
	var iret = {};
	var result = $(this).attr('iresult').split('|');
	for (var i in result) {
		var r = result[i].split('=');
		iret[r[0]] = r[1];
	}
	
	$(this).autocomplete({
	    source: function (request, response) {
	        $.get(source + 'key=' + request.term, function (ret) {
	            response(ret.data);
	        }, 'json');
	    },
	    select: function (event, ui) {
	    	for (var k in iret) {
	    		if ($(k).length > 0){
	    			if ($(k)[0].nodeName == "IMG") {
		    			$(k).attr('src', ui.item[iret[k]]);
		    		} else {
		    			$(k).val(ui.item[iret[k]] + '');
		    		}
	    		}
	    	}
	    	
	        yyele.blur().focus().change();
	    },
	    response: function (event, ui) {
	    }
	}).autocomplete("instance")._renderItem = function (ul, item) {
        item.value = item[ivalue];
	    return $("<li>").append("<a>" + eval(ishow) + "</a>").appendTo(ul);
	};
})