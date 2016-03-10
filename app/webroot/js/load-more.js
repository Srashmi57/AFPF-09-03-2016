//variable initialization 
var current_page	=	0;
var loading			=	false;
var oldscroll		=	0;
var total_pages     =  8;
$(document).ready(function(){
 
$.ajax({
		'url':strGlobalSiteBasePath+'websites/getRecentMedia',
		'type':'post',
		'dataType': 'json',
		'cache':'false',
		'data': 'page='+current_page,
		success:function(data){
			
			
			//$(data.html).hide().appendTo('#thumbnails').fadeIn(1000);
			$('#thumbnails').html(data.content);
			//$(data.html).hide().appendTo('#thumbnails').fadeIn(1000);
			//current_page++;
		}
	});
	var timer, delay = 300; //5 minutes counted in milliseconds.
	
	
	

$('#thumbnails').addClass('loading'); 

loading = true;

timer = setInterval(function(){
	current_page = current_page+1;
	//alert(current_page);
	
   						$.ajax({
							'url':strGlobalSiteBasePath+'websites/getRecentMedia',
							'type':'post',
							'dataType': 'json',
							'cache':'false',
							'data': 'page='+current_page,
							success:function(data){
								
								$('#thumbnails').append(data.content);
								
								$('#thumbnails').removeClass('loading');
								loading = false;
							}
						});
						if(current_page>=10)
						{
							clearInterval(timer);
						}
	
}, delay);


	 
	
	$('.thumbnail img').click( function() {
		alert("hi");
		
		$("[rel^='lightbox']").prettyPhoto();
	});
});