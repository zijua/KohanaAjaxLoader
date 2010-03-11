/**
 * @author giovanni manuel toppi
 */

jQuery.fn.ajaxcontent = function(options){
    settings = jQuery.extend({
		baseURL : "http://localhost/",
        category: "default"
    }, options);
	var container = this;
	$.ajax({
		url: settings.baseURL + "jquery/ajaxcontent/num_of_views/" + settings.category,
		type: "POST",
		dataType: "json",
		async: false,
		success: function(num){
			for(var i = 0; i < num; i++){
				$.ajax({
					url: settings.baseURL + "jquery/ajaxcontent/view/" + i + "/" + settings.category,
					type: "POST",
					dataType: "json",
					async: false,
					success: function(view){
							$(container).append('<div class="widget">' + view + '</div>');
					}
				});
			}
		}
	});
}