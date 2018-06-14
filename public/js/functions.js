$(function() {
	/*Define some constants */
	const ARTICLE_TITLE =  document.title;
	const ARTICLE_URL = encodeURIComponent(window.location.href);
	const MAIN_IMAGE_URL = encodeURIComponent($('meta[property="og:image"]').attr('content'));


	$('.share-fb').click(function(){
		open_window('http://www.facebook.com/sharer/sharer.php?u='+ARTICLE_URL+'/'+user+'/1', 'facebook_share');
		window.location = "/insert/"+article+"/"+user+"/1";
	});

	$('.share-twitter').click(function(){
		open_window('http://twitter.com/share?url='+ARTICLE_URL+'/'+user+'/2', 'twitter_share');
		window.location = "/insert/"+article+"/"+user+"/2";
	});

	 $('.share-whats').click(function(){
	 	open_window('whatsapp://send?text='+ARTICLE_URL+'/'+user+'/3', 'share/whatsapp/share');
		window.location = "/insert/"+article+"/"+user+"/3";
	 });

	function open_window(url, name){
		window.open(url, name, 'height=320, width=640, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no');
	}
});
