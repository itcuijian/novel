window.onload=function(){
	//分类导航
	(function(){
		var a = $("#a").children("a");
		for(var i=0;i<a.length;i++){
			if(String(window.location).indexOf(a[i].href) > -1){
				$("#a").children("a").attr("class", "");
				a[i].className = "active";
			}
		}
	})();

	//排行榜模块的功能
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
	
};