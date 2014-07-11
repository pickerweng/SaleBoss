/*
* \Common namespace
* common functions goes here
* @author <Reza Shadman>
* @date <10th,March,2014>
*/
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

	Common.submitDeleteForm = function(elem){
		$(elem).submit();
	}
})(jQuery); 