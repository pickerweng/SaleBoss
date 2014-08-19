(function($){
	jQuery.namespace('Common');
	
	Common.isFloat = function (f){
		return f === +f && f !== (f|0);
	}

	Common.isInteger = function (z){
		return z === +z && z === (z|0);
	}
	Common.setDeleteURL = function(elem,formElem){
		var url = $(elem).attr('delete-url');
		$(formElem).attr('action',url);
	}

    Common.setUpdateURL = function(elem, formElem, data){
        var url = $(elem).attr('update-url');
        $(".modal-body").html(data);
        $(formElem).attr('update-url');
    }

	Common.submitDeleteForm = function(elem){
		$(elem).submit();
	}

    Common.submitUpdateForm = function(elem){
        $(elem).submit();
    }
})(jQuery);

Common.setDeleteURL()