(function($) {
	$(document).ready(function(e) {
		$(".rhea-widget.tabs-widget > .rhea-tabs-content > .rhea-tab-content").hide();
		$("ul.rhea-tabs").each(function(){
			$(this).children().first().addClass("active").show();
			$(this).next().children(".rhea-tab-content").first().show();
		});
		$(".rhea-tab-content .rhea-tab-content:first").show();	
		
		//On Click

		$("ul.rhea-tabs li").click(function() {
			$(this).parent().find("li").removeClass("active");
			$(this).addClass("active");
			$(this).parent().parent().find(".rhea-tab-content").hide();
			var activeTab = $(this).parent().children().index(this);
			$(this).parent().next().children(".rhea-tab-content").eq(activeTab).fadeIn();
			//$(activeTab).fadeIn();

			return false;

		});
	});
})(jQuery);


