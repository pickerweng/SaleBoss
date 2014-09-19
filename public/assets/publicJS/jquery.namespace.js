/*
* Defaults Extensions needed
* All jQuery etc. extensions go here
* @author <Reza Shadman>
* @date <10th,March,2014>
*/
(function($){
    // Using Namespaces in jQuery
    jQuery.namespace = function() {
        var a=arguments, o=null, i, j, d;
        for (i=0; i<a.length; i=i+1) {
            d=a[i].split(".");
            o=window;
            for (j=0; j<d.length; j=j+1) {
                o[d[j]]=o[d[j]] || {};
                o=o[d[j]];
            }
        }
        return o;
    };
})(jQuery);