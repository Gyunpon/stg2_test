//<![CDATA[
$(document).ready(function(){
	
	var uaInfo = UAChk();
	
//	console.log(follow_url);
	var js_follow_url = '<li><a href="' + follow_url + '">JS appendテスト フォローリニュアー</a></li>';
	
	$('.um-account .um-account-side ul li:nth-of-type(2)').after('<li><a href="/bookmark/">JS appendテスト ブックマーク</a></li>');
	$('.um-account .um-account-side ul li:nth-of-type(3)').after(js_follow_url);
});
//]]>