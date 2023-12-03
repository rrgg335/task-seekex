$(document).on('click','[confirm-href]',function(){
	if(confirm($(this).attr('confirm-text'))){
		window.location.href = $(this).attr('confirm-href');
	}
});