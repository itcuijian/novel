//排行榜模块
(function(){
	var ul = $(".rank").children("ul");
	for(var i=0;i<ul.length;i++){
		var li = ul[i].children;
		var span = ul[i].getElementsByTagName("span");

		li[9].className = "last";
		for(var j=0;j<3;j++){
			span[j].className = "active";
		}
	}
})();

//轮播图
(function(){
	//初始化
	var max = $('.max');
	var min = $('.min');
	var info = $('.picinfo');
	var img = max.children('img');
	img[0].style.display = 'block';
	min[0].className = 'active';
	info[0].style.display = 'block';

	//计数器
	var index = 1;

	//自动轮播
	var set = setInterval(countTime, 4000);


	//手动轮播
	$('.psmall').children('a').hover(function(){
		var i = getIndex(this);
		clearInterval(set);
		change(i);
	}, function(){
		var i = getIndex(this);
		index = i + 1;
		set = setInterval(countTime, 4000);
		
	});


	//改变状态
	function change(sum){
		for(var j=0;j<max.length;j++){
				img[j].style.display = 'none';
				min[j].className = null;
				info[j].style.display = 'none';
			}
			img[sum].style.display = 'block';
			min[sum].className = 'active';
			info[sum].style.display = 'block';
	}

	//计时器
	function countTime(){
		if(index >= max.length)
			index = 0;
		change(index);
		index++;
	}

	//求索引
	function getIndex(obj){
		var a = obj.parentNode.children;
		for(var i=0;i<a.length;i++){
			if(obj == a[i]){
				return i;
			}
		}
	}
})();

