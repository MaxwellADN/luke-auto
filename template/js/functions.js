$(function()
{
	var div = $('#popup');
	if(div.length)
	{
		setTimeout(function()
		{
			div.slideUp();
		}, 4000);
	}
	$('#tabs').tabs();
	$('.datepicker').datepicker({
		changeMonth: true,
		changeYear: true
	});
	$('a[href^="./#"]').click(function()
	{  
		var id = $(this).attr('href').substring(2);
		var offset = $(id).offset().top;
		$('html, body').animate({scrollTop: offset}, 'slow'); 
		return false;
	});
});