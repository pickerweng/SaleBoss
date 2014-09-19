(function($){
	jQuery.namespace('Common');

	Common.isFloat = function (f) {
		return f === +f && f !== (f|0);
	};

	Common.isInteger = function (z) {
		return z === +z && z === (z|0);
	};

	Common.setDeleteURL = function(elem,formElem) {
		var url = $(elem).attr('delete-url');
		$(formElem).attr('action',url);
	};

    Common.setUpdateURL = function(elem, formElem, data) {
        var url = $(elem).attr('update-url');
        $("#updateModal .modal-body").html(data);
        $(formElem).attr('action', url);
    };

	Common.submitDeleteForm = function(elem) {
		$(elem).submit();
	};

    Common.submitUpdateForm = function(elem) {
        $(elem).submit();
    };

    Common.getStatuses = function(key) {
        var statuses = {
            "0": "نا مشخص",
            "1": "موفق",
            "2": "بعدا مشخص میشود",
            "-1": "نا موفق"
        };
        return statuses[key];
    }

    Common.doRequest = function(ApiAddress,params, type) {
        type = (typeof type === 'undefined') ? 'GET' : type;
        return $.ajax({
            url: ApiAddress,
            type: type,
            dataType: 'json',
            data: params
        });
    }
})(jQuery);
