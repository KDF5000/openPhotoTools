$(document).ready(function($) {
	var page = 0;
	var imgAmount = 0;
	//
	var year = "2013";
	var month = $('.menu-icon-focus').attr("name");
	loadPhotos(year,month);
	//点击菜单
	$(".menu-ele").click(function(event) {
		/* Act on the event */
		$('.menu-icon-focus').attr('class', 'menu-icon');
		$(this).children('img').attr('class', 'menu-icon-focus');
		var year = "2013";
		var month = $(this).children('img').attr("name");
		loadPhotos(year,month);

	});
	
	//加载照片
	function loadPhotos(year,month){
		page = 0;
		$.ajax({
			url: '/loadPhoto.php',
			type: 'get',
			dataType: 'json',
			data: {"year": year,"month":month},
			success:function(data){
				showPhoto(data);
			},
			error:function(error){
				alert(error);
			}
		});
		
	}
	//显示photo
	/*
		<div class="img-left"><img src='Penguins.jpg'></img></div>
		<div class="center-img"><img src='Penguins.jpg'></img></div>
		<div class="img-right"><img src='Penguins.jpg'></img></div>	
	*/
	function showPhoto(data){
		$('.show-img').css('margin-left', '0');
		var urls = eval(data);
		imgAmount = urls.length;
		var html = '';
		for(var index in urls){
			var url = urls[index];
			html += "<div class='general-img'><img  class= 'scrollLoading' data-url='"+url+"' src='"+url+"'></img></div>";
		}
		$(".show-img").html(html);
		$('.general-img','.img-area').each(function(index, val) {
			 /* iterate through array or object */
			 if(index==page+1){
			 	$(this).attr('class', 'focus-img');
			 	return;
			 }
		});
	}
	//想左移动
	function moveLeft(){
		if(page==imgAmount-2){
			return;
		}
		page++;
		$('.show-img').css('margin-left', -233*page+'px');
		$('.focus-img').attr('class', 'general-img');	
		$('.general-img','.img-area').each(function(index, val) {
			 /* iterate through array or object */
			 if(index==page+1){
			 	$(this).attr('class', 'focus-img');
			 	return;
			 }
		});
	}
	//向右移动
	function moveRight(){
		if(page==-1)
		{
			return;
		}
		page--;
		$('.show-img').css('margin-left', -233*page+'px');
		$('.focus-img').attr('class', 'general-img');
		$('.general-img','.img-area').each(function(index, val) {
			 /* iterate through array or object */
			 if(index==page+1){
			 	$(this).attr('class', 'focus-img');
			 	return;
			 }
		});
	}
	//翻页
	$('.page-left').click(function(event) {
		/* Act on the event */
		moveLeft();
	});
	$('.page-right').click(function(event) {
		/* Act on the event */
		moveRight();
	});

});