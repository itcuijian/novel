$('.li').click(function(){
	var ul = $(this).children('ul');
	var span = $(this).children('span')[1];
	if($(span).attr('class') == 'glyphicon glyphicon-menu-down s'){
		$(this).css('background', '#1F1B13');
		$(span).attr('class', 'glyphicon glyphicon-menu-up s');
	}
	else{
		$(this).css('background', '');
		$(span).attr('class', 'glyphicon glyphicon-menu-down s');
	}
	
	$(ul).slideToggle();
	
});


(function(){
	var li = $('.box').children('li');
	var n = $('.nslide');
	$(li).bind("click",function(event){
		for(var i=0;i<li.length;i++){
			$(li[i]).css('background', '');
			$(n[i]).css('background', '');
		}
		$(this).css('background', '#514536');
		
		event.stopPropagation();            //阻止事件冒泡，点击变量li后不再执行slideToggle()
	});
})();


$('.nslide').click(function(){
	var li = $('.nslide');
	var box = $('.box').children('li');
	for(var i=0;i<li.length;i++){
		$(li[i]).css('background', '');
	}
	for(var j=0;j<box.length;j++){
		$(box[j]).css('background', '');
	}
	$(this).css('background', '#514536');
});


//初始化时显示
(function(){
	var li = $('.li');
	var span = $(li).children('span')[1];
	var box = $('.box');
	var bli = $('.box').children('li');

	$(li[0]).css('background', '#1F1B13');
	$(span).attr('class', 'glyphicon glyphicon-menu-up s');
	$(box[0]).css('display', 'block');
	$(bli[0]).css('background', '#514536');
})();