//<![CDATA[
$(document).ready(function(){
	
	var uaInfo = UAChk();
	
	$(".promise-text-block-folder-title").on("click", function() {
		$(this).next().slideToggle();
	});
	
});
//]]>